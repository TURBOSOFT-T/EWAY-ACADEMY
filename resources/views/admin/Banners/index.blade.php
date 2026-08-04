@section('titre', 'Liste des bannières')
@extends('admin.fixe')

@section('body')




    
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        
     
          



           

           
            <div class="content-wrapper">
                

                <div class="container-xxl flex-grow-1 container-p-y">
                   


                    <div class="container-xxl flex-grow-1 container-p-y">
                        
                    
                       
                        <!-- Sponsors List Table -->

                        <div class="card radius-15">
                          <div class="card-body">
                              <div class="d-flex justify-content-between">
                                  <div class="card-title">
                                      <h5 class="mb-0 my-auto">
                                        Gestion des bannières
                                      </h5>
                                  </div>
                                  <div>
                                      {{-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                          data-bs-target="#import">
                                          <i class="ri-user-add-line"></i>
                                          Importer fiche exel
                                      </button> --}}
                                    
          
                                      <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                      data-bs-target="#add">
                                      <i class="ri-user-add-line"></i>
                                      Ajouter une bannière
                                  </button>
                                  </div>
                              </div>
                              <hr />
                            
                              @include('components.alert')

                              @livewire('Banners.Liste')
          
                            
          
                          </div>
                      </div>
  
                        
                      </div>



                </div>

            </div>

     


    </div>
</div>
  <!-- Center modal content -->
  <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="myCenterModalLabel">
                    Ajouter une bannières.
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @livewire('Banners.Add')
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="../../assets/js/app-user-list.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script>

@endsection