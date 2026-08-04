        

           @if (session()->has('error'))
               <div class="alert alert-danger p-3 small">
                   {{ session('error') }}
               </div>
           @endif
           @if (session()->has('success'))
               <div class="alert alert-success p-3 small">
                   {{ session('success') }}
               </div>
           @endif
           <form  wire:submit="save" data-toggle="validator" class="wow fadeInUp" data-wow-delay="0.25s" >
               <div class="row" >
                   <div class="form-group col-md-6 mb-4" >
                       <input class="form-control" wire:model="nom"  type="text"
                           placeholder="   {!! \App\Helpers\TranslationHelper::TranslateText('Votre nom') !!}" id="fullname" required="required">
                       @error('nom')
                           <span class="small text-danger">
                               {{ $message }}
                           </span>
                       @enderror
                       <div class="help-block with-errors"></div>
                   </div>

                   <div class="form-group col-md-6 mb-4">
                       <input type="email" wire:model="email" name="email" class="form-control" id="email"
                           placeholder="E-Mail" required="">
                       @error('email')
                           <span class="small text-danger">
                               {{ $message }}
                           </span>
                       @enderror
                       <div class="help-block with-errors"></div>
                   </div>

                   <div class="form-group col-md-6 mb-4">
                       <input class="form-control" wire:model="telephone" id="phone" type="text"
                           placeholder="   {!! \App\Helpers\TranslationHelper::TranslateText('Votre téléphone') !!}" id="telephone" required="required">
                       @error('telephone')
                           <span class="small text-danger">
                               {{ $message }}
                           </span>
                       @enderror
                       <div class="help-block with-errors"></div>
                   </div>

                   <div class="form-group col-md-6 mb-4">
                       <input class="form-control" wire:model="sujet" type="text"
                           placeholder="   {!! \App\Helpers\TranslationHelper::TranslateText('Sujet') !!}" id="subject" required="required">
                       @error('sujet')
                           <span class="small text-danger">
                               {{ $message }}
                           </span>
                       @enderror
                       <div class="help-block with-errors"></div>
                   </div>

                   <div class="form-group col-md-12 mb-5">
                     
                       <textarea class="form-control" id="msg" wire:model="message" placeholder="   {!! \App\Helpers\TranslationHelper::TranslateText('Laissez le message') !!}"
                           required="required"></textarea>
                       @error('message')
                           <span class="small text-danger">
                               {{ $message }}
                           </span>
                       @enderror
                       <div class="help-block with-errors"></div>
                   </div>

                   <div class="col-md-12">
                       <button type="submit" class="btn-default disabled">
                           <span wire:loading>
                               <img src="/icons/kOnzy.gif" height="20" width="20" alt="" srcset="">
                           </span> 
                           {!! \App\Helpers\TranslationHelper::TranslateText('Envoyez le message') !!}</button>
                     
                   </div>
               </div>
           </form>
