<?php

namespace App\Services\Admin\Offermanagement;


use App\Models\offer;
use Illuminate\Support\Str;

class OfferManagementService
{
    public function store($data)
    {
        $offer = new offer();
        $offer->title = $data->title;
        $offer->discount = $data->discount;
        $offer->description = $data->description;
        $offer->offer_percentage = $data->percentage;
        $offer->stock = $data->stock;

        $offer->price = $data->price;
        $offer->start_date = $data->start_date;
        $offer->end_date = $data->end_date;
        $offer->SKU = str::uuid();
        $offer->slug = str::slug($offer->SKU . ' ' . $offer->description . ' ' . now());
        // Handle file upload if you have a photo field
        if ($data->hasFile('photo')) {
            $file = $data->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName); // Adjust folder path as needed
            $offer->photo = 'uploads/' . $fileName; // Add missing slash
        }
        $offer->save();
        return $offer;
    }
    public function delete($id)
    {
        $offer = offer::findOrFail($id);
        $offer->delete();

        return $offer;
    }
    public function update($data)
    {
        $id = $data->id;
        $offer = Offer::findOrFail($id);
        $offer->title = $data->title;
        $offer->description = $data->description;
        $offer->price = $data->price;
        $offer->offer_percentage = $data->percentage; // Ensure 'percentage' is fillable in your model
        $offer->discount = $data->discount;
        $offer->stock = $data->stock;
        $offer->start_date = $data->start_date;
        $offer->end_date = $data->end_date;

        if ($data->hasFile('photo')) {
            $file = $data->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName); // Adjust folder path as needed
            $offer->photo = 'uploads/' . $fileName;
        }

        $offer->save();
        return $offer;
    }
}
