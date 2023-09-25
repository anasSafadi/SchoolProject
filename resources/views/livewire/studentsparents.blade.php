
    <div>
        <button class="btn btn-danger mb-4" wire:click="change_page">@if($list_parents)<span class="ti-plus"></span>
            @else <span class="ti-list-ol"></span> @endif</button>
        @if($list_parents)
    @include("livewire.listparents")
            @else


            @php
                if (\Illuminate\Support\Facades\App::getLocale()=="ar"){
               $worlds=["father_information"=>"معلومات الاب","mother_information"=>"معلومات الام","end"=>"الوثائق","father"=>"الاب","name"=>"اسم","last_name"=>"اسم العائلة","job"=>"الوظيفة"];

                }
                else{

               $worlds=["father_information"=>"Father Information","mother_information"=>"MOther Information","end"=>"Documents","name"=>"name","last_name"=>"last name","job"=>"job"];
                }

            @endphp


        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button"
                       class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                    <h6>{{$worlds["father_information"]}}</h6>
                </div>
                <div class="stepwizard-step" >
                    <a href="#step-2" type="button"
                       class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                    <h6>{{$worlds["mother_information"]}}</h6>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button"
                       class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                       disabled="disabled">3</a>
                    <h5>{{$worlds["end"]}}</h5>
                </div>
            </div>
        </div>



            @if($currentStep<3)
        @include('livewire.form'.$currentStep)
                     @endif




            @if($currentStep==3)
        <div class="row setup-content {{ $currentStep == 3 ? 'displayNone' : '' }}" id="step-3">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                                <input class="form-control"wire:model="photo" type="file" multiple accept="image/*">
                            <h3 wire:loading>loading...</h3>
                                @if ($photo)
                                    <ul>
                                   @foreach($photo as $item)

                                            <li><u>{{$item->getClientOriginalName()}}</u></li>
                                        @endforeach
                                    </ul>
                                @endif


                            <h3 style="font-family: 'Cairo', sans-serif;">هل انت متاكد من حفظ البيانات ؟</h3><br>
                            <button class="btn btn-danger  nextBtn btn-lg pull-right" type="button"
                                    wire:click="back_step">السابق</button>
                            <button class="btn btn-success  btn-lg pull-right mr-10 ml-10" wire:click="create_parents"
                                    type="button">انهاء</button>
                        </div>
                    </div>
                </div>    @endif
        @endif


    </div>




