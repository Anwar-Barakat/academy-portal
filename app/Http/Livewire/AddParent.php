<?php

namespace App\Http\Livewire;

use App\Http\Traits\AttachFileTrait;
use App\Models\Blood;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\ParentAttachment;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use phpDocumentor\Reflection\Types\Parent_;

class AddParent extends Component
{
    use WithFileUploads;

    public $successfulMsg = '';

    public $errorMsg = '';

    public $currentStep = 1,
        $email,
        $password,

        $father_name_ar,
        $father_name_en,
        $father_job_ar,
        $father_job_en,
        $father_passport,
        $father_identification,
        $father_phone,
        $father_nationality_id,
        $father_blood_id,
        $father_religion_id,
        $father_address,

        $mother_name_ar,
        $mother_name_en,
        $mother_job_ar,
        $mother_job_en,
        $mother_passport,
        $mother_identification,
        $mother_phone,
        $mother_nationality_id,
        $mother_blood_id,
        $mother_religion_id,
        $mother_address;

    public $photos = [], $parent_id;

    public $showTable = true;

    public $updateMode = false,
        $my_parent_id;



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email'                         => 'required|email|unique:my_parents,email',
            'password'                      => 'required|min:8',
            'father_name_ar'                => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'father_name_en'                => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'father_job_ar'                 => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'father_job_en'                 => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'father_passport'               => 'required|min:10|max:10|unique:my_parents,father_passport',
            'father_identification'         => 'required|min:10|max:10|unique:my_parents,father_identification',
            'father_phone'                  => 'required|min:10|unique:my_parents,father_phone',
            'father_nationality_id'         => 'required',
            'father_blood_id'               => 'required',
            'father_religion_id'            => 'required:in:1,2,3',
            'father_address'                => 'required|min:10',
        ]);
    }

    public function render()
    {
        return view('livewire.add-parent', [
            'nationalities'     => Nationality::all(),
            'bloods'            => Blood::all(),
            'religions'         => Religion::all(),
            'my_parents'        => MyParent::latest()->get(),
        ])->layout(
            'layouts.master',
            ['header' => __('msgs.add', ['name' => __('parent.parent')])]
        );;
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'email'                         => ['required', 'email', 'unique:my_parents,email,' . $this->id],
            'password'                      => 'required|min:8',
            'father_name_ar'                => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'father_name_en'                => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'father_job_ar'                 => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'father_job_en'                 => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'father_passport'               => ['required', 'min:10', 'max:10', 'unique:my_parents,father_passport,' . $this->id],
            'father_identification'         => ['required', 'min:10', 'max:10', 'unique:my_parents,father_identification,' . $this->id],
            'father_phone'                  => ['required', 'min:10', 'unique:my_parents,father_phone,' . $this->id],
            'father_nationality_id'         => 'required',
            'father_blood_id'               => 'required',
            'father_religion_id'            => 'required:in:1,2,3',
            'father_address'                => 'required|min:10',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'mother_name_ar'                => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'mother_name_en'                => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'mother_job_ar'                 => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'mother_job_en'                 => 'required|min:3|regex:/^[\pL\s\-]+$/u',
            'mother_passport'               => ['required', 'min:10', 'max:10', 'unique:my_parents,mother_passport,' . $this->id],
            'mother_identification'         => ['required', 'min:10', 'max:10', 'unique:my_parents,mother_identification,' . $this->id],
            'mother_phone'                  => ['required', 'min:10', 'unique:my_parents,mother_phone,' . $this->id],
            'mother_nationality_id'         => 'required',
            'mother_blood_id'               => 'required',
            'mother_religion_id'            => 'required:in:1,2,3',
            'mother_address'                => 'required|min:10',
        ]);

        $this->currentStep = 3;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function showParentForm()
    {
        $this->showTable = false;
    }

    public function submitForm()
    {
        try {
            $my_parent = new MyParent();

            $my_parent->email                   = $this->email;
            $my_parent->password                = Hash::make($this->password);
            $my_parent->father_name             = ['ar'    => $this->father_name_ar, 'en'       => $this->father_name_en];
            $my_parent->father_job              = ['ar'    => $this->father_job_ar, 'en'        => $this->father_job_en];
            $my_parent->father_passport         = $this->father_passport;
            $my_parent->father_identification   = $this->father_identification;
            $my_parent->father_phone            = $this->father_phone;
            $my_parent->father_nationality_id   = $this->father_nationality_id;
            $my_parent->father_blood_id         = $this->father_blood_id;
            $my_parent->father_religion_id      = $this->father_religion_id;
            $my_parent->father_address          = $this->father_address;

            $my_parent->mother_name             = ['ar'    => $this->mother_name_ar, 'en'       => $this->mother_name_en];
            $my_parent->mother_job              = ['ar'    => $this->mother_job_ar, 'en'        => $this->mother_job_en];
            $my_parent->mother_passport         = $this->mother_passport;
            $my_parent->mother_identification   = $this->mother_identification;
            $my_parent->mother_phone            = $this->mother_phone;
            $my_parent->mother_nationality_id   = $this->mother_nationality_id;
            $my_parent->mother_blood_id         = $this->mother_blood_id;
            $my_parent->mother_religion_id      = $this->mother_religion_id;
            $my_parent->mother_address          = $this->mother_address;
            $my_parent->save();

            if (!empty($this->photos)) {
                $father_id = MyParent::latest()->first()->id;
                foreach ($this->photos as $photo) {
                    $name   = $photo->getClientOriginalName();
                    $photo->storeAs('attachments/parents/' . $my_parent->father_name, $name, 'parents_attachments');

                    $image                  = new Image();
                    $image->file_name       = $name;
                    $image->imageable_id    =  $father_id;
                    $image->imageable_type  = 'App\Models\MyParent';
                    $image->save();
                }
            }

            $this->currentStep = 1;

            $this->reset();

            $this->successfulMsg = __('msgs.added', ['name' => __('parent.parent')]);
        } catch (\Throwable $th) {
            $this->errorMsg = $th->getMessage();
        }
    }

    public function edit($id)
    {
        $this->showTable = false;
        $this->updateMode = true;

        $my_parent = MyParent::where('id', $id)->first();
        $this->parent_id                = $my_parent->id;

        $this->email                    = $my_parent->email;
        $this->password                 = $my_parent->password;
        $this->father_name_ar           = $my_parent->getTranslation('father_name', 'ar');
        $this->father_name_en           = $my_parent->getTranslation('father_name', 'ar');
        $this->father_job_ar            = $my_parent->getTranslation('father_job', 'ar');
        $this->father_job_en            = $my_parent->getTranslation('father_job', 'ar');
        $this->father_passport          = $my_parent->father_passport;
        $this->father_identification    = $my_parent->father_identification;
        $this->father_phone             = $my_parent->father_phone;
        $this->father_nationality_id    = $my_parent->father_nationality_id;
        $this->father_blood_id          = $my_parent->father_blood_id;
        $this->father_religion_id       = $my_parent->father_religion_id;
        $this->father_address           = $my_parent->father_address;

        $this->mother_name_ar           = $my_parent->getTranslation('mother_name', 'ar');
        $this->mother_name_en           = $my_parent->getTranslation('mother_name', 'ar');
        $this->mother_job_ar            = $my_parent->getTranslation('mother_job', 'ar');
        $this->mother_job_en            = $my_parent->getTranslation('mother_job', 'ar');
        $this->mother_passport          = $my_parent->mother_passport;
        $this->mother_identification    = $my_parent->mother_identification;
        $this->mother_phone             = $my_parent->mother_phone;
        $this->mother_nationality_id    = $my_parent->mother_nationality_id;
        $this->mother_blood_id          = $my_parent->mother_blood_id;
        $this->mother_religion_id       = $my_parent->mother_religion_id;
        $this->mother_address           = $my_parent->mother_address;
    }

    public function firstStepEdit()
    {
        $this->currentStep = 2;
        $this->updateMode = true;
    }

    public function secondStepEdit()
    {
        $this->currentStep = 3;
        $this->updateMode = true;
    }

    public function updateForm($id)
    {

        $this->parent_id = $id;
        if (!empty($this->parent_id)) {
            $my_parent = MyParent::findOrFail($this->parent_id)->update([
                'email'                      => $this->email,
                'password'                   => Hash::make($this->password),
                'father_name'                => ['ar'    => $this->father_name_ar, 'en'     => $this->father_name_en],
                'father_job'                 => ['ar'    => $this->father_job_ar, 'en'      => $this->father_job_en,],
                'father_passport'            => $this->father_passport,
                'father_identification'      => $this->father_identification,
                'father_phone'               => $this->father_phone,
                'father_nationality_id'      => $this->father_nationality_id,
                'father_blood_id'            => $this->father_blood_id,
                'father_religion_id'         => $this->father_religion_id,
                'father_address'             => $this->father_address,

                'mother_name'                => ['ar'    => $this->mother_name_ar, 'en'     => $this->mother_name_en],
                'mother_job'                 => ['ar'    => $this->mother_job_ar, 'en'      => $this->mother_job_en,],
                'mother_passport'            => $this->mother_passport,
                'mother_identification'      => $this->mother_identification,
                'mother_phone'               => $this->mother_phone,
                'mother_nationality_id'      => $this->mother_nationality_id,
                'mother_blood_id'            => $this->mother_blood_id,
                'mother_religion_id'         => $this->mother_religion_id,
                'mother_address'             => $this->mother_address,
            ]);

            $parent_name = MyParent::findOrFail($this->parent_id)->toArray();

            dd($parent_name['father_name']);

            // dd($parent_name);

            // if (!empty($this->photos)) {
            //     $father_id = MyParent::latest()->first()->id;
            //     foreach ($this->photos as $photo) {

            //         $exists =   Storage::disk('parents_attachments')->exists('attachments/parents/' . $parent_name . '/' . $photo);
            //         if ($exists)
            //             Storage::disk('parents_attachments')->delete('attachments/parents/' . $parent_name . '/' . $photo);

            //         Image::where('imageable_id', $father_id)->delete();


            //         dd('done000');

            //         $name   = $photo->getClientOriginalName();
            //         $photo->storeAs('attachments/parents/' . $parent_name, $name, 'parents_attachments');

            //         $image                  = new Image();
            //         $image->file_name       = $name;
            //         $image->imageable_id    = $father_id;
            //         $image->imageable_type  = 'App\Models\MyParent';
            //         $image->save();
            //     }
            // }

            $this->showTable = true;

            $this->reset();

            $this->successfulMsg = __('msgs.updated', ['name' => __('parent.parent')]);
        }
    }

    public function delete($id)
    {
        MyParent::findOrFail($id)->delete();
        $this->reset();
        $this->successfulMsg = __('msgs.deleted', ['name' => __('parent.parent')]);
    }

    public function deleteImage($parentId, $imageId)
    {
        $image          = Image::where('id', $imageId)->first();
        $file_name      = $image->file_name;

        $parent         = MyParent::where('id', $parentId)->first();
        $parent_name    = $parent->father_name;


        $exists =   Storage::disk('parents_attachments')->exists('attachments/parents/' . $parent_name . '/' . $file_name);
        if ($exists)
            Storage::disk('parents_attachments')->delete('attachments/parents/' . $parent_name . '/' . $file_name);

        Image::where('id', $imageId)->delete();
    }
}
