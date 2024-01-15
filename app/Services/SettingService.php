<?php

namespace Services;

use App\Models\Setting;

class SettingService
{

    public function model()
    {
        return new Setting;
    }

    public function all()
    {
        return $this->model()->get();
    }

    public function allBySlug($slug)
    {
        return $this->model()->where('slug', $slug)->get();
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model()->findOrFail($id);
    }

    public function findBySlug($slug, $default = null)
    {
        $setting = $this->model()->where('slug', $slug)->first();

        return $setting ? $setting->value : $default;
    }

    public function update($request, $id)
    {
        return $this->find($id)->update([
            'slug'  => $request->slug,
            'title' => $request->title,
            'value' => $request->value,
        ]);
    }

    public function init()
    {
        $this->model()->truncate();

        $data = [
            ['slug' => 'logo', 'title' => 'Logo Website', 'value' => ''],
            ['slug' => 'favicon', 'title' => 'Favicon Website', 'value' => ''],
            ['slug' => 'description', 'title' => 'Description', 'value' => 'Platform pembelajaran online (Kursus Online) yang didirikan untuk membantu orang dewasa dan juga para profesional untuk bisa belajar dan mengajar secara online.'],
            ['slug' => 'email', 'title' => 'Email', 'value' => 'hiskianggi@gmail.com'],
            ['slug' => 'wa_isactive', 'title' => 'Aktifkan Notifikasi WA (y/n)', 'value' => 'y'],
            ['slug' => 'mt_instruction', 'title' => 'Instruksi Transfer Manual', 'value' => '<p>Silahkan lakukan pembayaran TEPAT sesuai nominal ke salah satu rekening resmi berikut.</p>
        <ul>
            <li>Bank BRI: 029283773336 a/n Aditya</li>
        </ul>
        <p>Setelah melakukan transfer, silahkan mengirim bukti transfer ke <a href="http://wa.me/6285777727179">Whatsapp admin disini</a>. Admin akan segera mengkonfirmasi.</p>'],

        ];

        return $this->model()->insert($data);
    }
}
