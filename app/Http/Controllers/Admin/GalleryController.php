<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct()
    {
    }

    /**
     * gellary listing
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     *
     */
    public function index()
    {
        if (!$this->checkPermission('list-gallery')) {
            return redirect()->back()->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Permission denied."
                ]
            ]);
        }

        $galleryArr = Gallery::orderBy('created_at', 'DESC')->get();

        $dataArr = [
            "page_title" => "Gallery",
            "galleryArr" => $galleryArr
        ];

        return view('admin.gallery.index')->with('dataArr', $dataArr);
    }


    /**
     * gellary add page
     * @return  \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     *
     */
    public function galleryAdd()
    {
        if (!$this->checkPermission('create-gallery')) {
            return redirect()->back()->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Permission denied."
                ]
            ]);
        }
        $dataArr = [
            "page_title" => "Add Gallery Image"
        ];

        return view('admin.gallery.add_gallery')->with('dataArr', $dataArr);
    }


    /**
     * gellary show
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function galleryView($id)
    {
        $galleryArr = Gallery::find($id);
        $dataArr = [
            "page_title" => "View Gallery",
            "galleryArr" => $galleryArr
        ];

        return view('admin.gallery.view_gallery')->with('dataArr', $dataArr);
    }


    /**
     * gellary save
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function galleryInsert(Request $request)
    {
        if (!$this->checkPermission('create-gallery')) {
            return redirect()->back()->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Permission denied."
                ]
            ]);
        }
        $request->validate([
            'gallery_name' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg'
        ]);

        $gallery = Gallery::create([
            'gallery_name' => $request->gallery_name
        ]);

        $img = $request->image;
        if ($img) {
            foreach ($img as $img) {
                $uploadedFile = $img;
                $filename = time() . "." . $uploadedFile->getClientOriginalExtension();

                if (!Storage::makeDirectory('public/' . self::GALLERY_PIC_FOLDER)) {
                    throw new \Exception('Could not create the directory');
                }

                Storage::disk('public')->putFileAs(
                    self::GALLERY_PIC_FOLDER,
                    $uploadedFile,
                    $filename
                );

                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image' => $filename,
                ]);
            }
        }

        return redirect()->route('admin.gallery')->with([
            "message" => [
                "result" => "success",
                "msg" => "Gallery added successfully."
            ]
        ]);
    }


    /**
     * gellary edit page_title
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function galleryEdit($id)
    {
        if (!$this->checkPermission('edit-gallery')) {
            return redirect()->back()->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Permission denied."
                ]
            ]);
        }
        $galleryArr = Gallery::find($id);
        $dataArr = [
            "page_title" => "Edit Gallery",
            "galleryArr" => $galleryArr
        ];

        return view('admin.gallery.edit_gallery')->with('dataArr', $dataArr);
    }

    /**
     * gellary update
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function galleryUpdate(Request $request, $id)
    {
        if (!$this->checkPermission('edit-gallery')) {
            return redirect()->back()->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Permission denied."
                ]
            ]);
        }
        $galleryArr = Gallery::find($id);
        $request->validate([
            'gallery_name' => 'nullable',
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg'
        ]);

        Gallery::find($id)->update([
            'gallery_name' => $request->gallery_name
        ]);

        $img = $request->image;
        if ($img) {
            if (!is_null($galleryArr->image)) {
                Storage::disk('public')->delete(self::GALLERY_PIC_FOLDER . '/' . $galleryArr->image);
            }
            foreach ($img as $img) {
                $uploadedFile = $img;
                $filename = time() . "." . $uploadedFile->getClientOriginalExtension();

                if (!Storage::makeDirectory('public/' . self::GALLERY_PIC_FOLDER)) {
                    throw new \Exception('Could not create the directory');
                }

                Storage::disk('public')->putFileAs(
                    self::GALLERY_PIC_FOLDER,
                    $uploadedFile,
                    $filename
                );

                GalleryImage::create([
                    'gallery_id' => $id,
                    'image' => $filename
                ]);
            }
        }

        return redirect()->route('admin.gallery')->with([
            "message" => [
                "result" => "success",
                "msg" => "Gallery updated successfully."
            ]
        ]);
    }

    /**
     * gellary delete
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function galleryRemove($id)
    {
        if (!$this->checkPermission('delete-gallery')) {
            return redirect()->back()->with([
                "message" => [
                    "result" => "error",
                    "msg" => "Permission denied."
                ]
            ]);
        }
        $galleryImg = GalleryImage::whereGalleryId($id)->get();
        if (!empty($galleryImg)) {
            foreach ($galleryImg as $galleryImg) {
                Storage::disk('public')->delete(self::GALLERY_PIC_FOLDER . '/' . $galleryImg->image);
            }
        }
        Gallery::find($id)->delete();
        GalleryImage::whereGalleryId($id)->delete();

        return redirect()->route('admin.gallery')->with([
            "message" => [
                "result" => "success",
                "msg" => "Gallery deleted successfully."
            ]
        ]);
    }

    /**
     * gellary single image deleted
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function galleryImgRemove(Request $request)
    {
        $response = [
            'jsonrpc'   => '2.0'
        ];

        $galleryImgArr = GalleryImage::find($request->img_id);

        if (!is_null($galleryImgArr)) {
            Storage::disk('public')->delete(self::GALLERY_PIC_FOLDER . '/' . $galleryImgArr->image);
        }
        $remove = GalleryImage::find($request->img_id)->delete();

        if ($remove) {
            $response['status'] = "success";
            return response()->json($response, 200);
        } else {
            $response['status'] = "error";
            return response()->json($response, 200);
        }
    }
}
