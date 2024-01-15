<?php

namespace Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileService
{
    public function upload($file, $path = null)
    {
        if (!is_null($file)) {
            is_null($path) ?? $this->delete($path);

            $path = 'public/uploads/files/' . $this->guard() . '/' . auth()->user()->id . '/';

            Storage::disk('local')->makeDirectory($path);

            $name = time() . '.' . $file->getClientOriginalExtension();

            Storage::putFileAs($path, $file, $name);

            return $path . $name;
        }

        return $path;
    }

    public function image($file, $path = null)
    {
        if (!is_null($file)) {
            is_null($path) ?? $this->delete($path);

            $path = 'public/uploads/images/' . $this->guard() . '/' . auth()->user()->id . '/';

            Storage::disk('local')->makeDirectory($path);
            
            $path .= time() . '.' . $file->getClientOriginalExtension();

            $file = Image::make($file)->save(storage_path('app/' . $path));

            return $path;
        }

        return $path;
    }

    public function editor($content)
    {
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $type = $groups['mime'];

                $path = 'public/uploads/images/' . $this->guard() . '/' . auth()->user()->id . '/';

                Storage::disk('local')->makeDirectory($path);
                
                $path .= uniqid() . '.' . $type;

                $file = Image::make($src)->encode($type, 100)->save(storage_path('app/' . $path));

                $image->removeAttribute('src');
                $image->setAttribute('src', Storage::url($path));
            }
        }

        return $dom->saveHTML();
    }

    public function delete($path)
    {
        return Storage::delete($path);
    }

    private function guard()
    {
        if (auth('admin')->check()) {
            return 'admin';
        } elseif (auth('team')->check()) {
            return 'team';
        } else {
            return 'user';
        }
    }
}