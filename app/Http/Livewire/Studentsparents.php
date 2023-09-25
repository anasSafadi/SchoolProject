<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\Teacher\Area;
use App\Models\Teacher\studentParent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Studentsparents extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $currentStep=1,$list_parents=True;
    public $email,$photo;
    public $password;
    public $name_father,$job_father,$area_father,$father_phone,$father_id_number;
    public $name_mother,$job_mother,$area_mother,$mother_phone,$mother_id_number;

    protected $rules=["name_father"=>"required","email"=>"required","password"=>"required"];

    public function render()
    {
        return view('livewire.studentsparents',[
            "areas"=>Area::all(),
            "studentParent"=>studentParent::all(),
        ]);
    }
    public function next_step(){
        $this->validate();
        $this->currentStep++;
    }
    public function back_step(){
        $this->currentStep--;
    }
    public function create_parents(){
       $p=studentParent::create([
           "email"=>$this->email,
           "password"=>Hash::make($this->password),
           "name_father"=>$this->name_father,
           "phone_father"=>$this->father_phone,
           "job_father"=>$this->job_father,
           "father_id_number"=>$this->father_id_number,
           'area_father_id'=>$this->area_father,
       ]);

       if(isset($this->photo)){
       foreach ($this->photo as $photo){
           $photo->storeAs("300",uniqid().".".$photo->extension());
           File::create([
               "url"=>$temp=uniqid(),
               "client_name"=>$photo->getClientOriginalName(),
               "fileable_id"=>$p->id,
               "fileable_type"=>"App\Models\Teacher\studentParent"
           ]);
       }}
       $this->currentStep=1;
        $this->email=$this->password=$this->name_father=$this->father_phone=$this->job_father=$this->father_id_number=$this->area_father=null;
        $this->name_father=null;
        $this->job_father=null;
        $this->area_father=null;
        $this->father_phone=null;
        $this->father_id_number=null;
        $this->photo=null;

        $this->alert('success', 'Basic Alert',[
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
        ]);
    }
    public function change_page(){
        if($this->list_parents){
            $this->list_parents=false;
        }else{$this->list_parents=true;}


    }
    public function delete_parents($id)
    {
        $item = studentParent::find($id);


        if ($item->sons->count() > 0) {

            $this->alert('warning', 'DELETE REJECT', [

                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        } else {
            $item->delete();
            $this->alert('warning', 'Delete done', [

                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
    }


        public function edit_form($id){
            $this->list_parents=false;
            $parent=studentParent::find($id);
            $this->name_father=$parent->name_father;
            $this->job_father=$parent->job_father;
            $this->area_father=$parent->area_father_id;
            $this->father_phone=$parent->phone_father;
            $this->father_id_number=$parent->father_id_number;
        }



}
