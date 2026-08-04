    <!-- Center modal content -->
    <div class="modal fade" id="personnel-{{ $personnel->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="myCenterModalLabel">
                        Configuration des accès du personnel
                        <b class="text-capitalize"> {{ $personnel->nom }} </b>.
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('update-personnel-permissions') }}" method="post">
                    <input type="hidden" name="id" value="{{ $personnel->id }}">
                    @csrf
                    <div class="modal-body text-start">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <b>Dashborad</b>
                                    </td>
                                    <td colspan="4">
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="dashboard" @checked($personnel->hasPermissionTo('dashboard'))> Voir
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Clients</b>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="clients_view" @checked($personnel->hasPermissionTo('clients_view'))> Voir
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="clients_delete" @checked($personnel->hasPermissionTo('clients_delete'))> Supprimer
                                    </td>
                                    <td colspan="2"></td>
                                </tr>
                               
                             
                               

                                <tr>
                                    <td>
                                        <b>Categories</b>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="category_view" @checked($personnel->hasPermissionTo('category_view'))> Voir
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="category_add" @checked($personnel->hasPermissionTo('category_add'))> Ajouter
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="category_edit" @checked($personnel->hasPermissionTo('category_edit'))> Modifier
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="category_delete" @checked($personnel->hasPermissionTo('category_delete'))> Supprimer
                                    </td>
                                </tr>
                               


                                <tr>
                                    <td>
                                        <b>Formation</b>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="formation_view" @checked($personnel->hasPermissionTo('formation_view'))> Voir
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="formation_add" @checked($personnel->hasPermissionTo('formation_add'))> Ajouter
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="formation_edit" @checked($personnel->hasPermissionTo('formation_edit'))> Modifier
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="formation_delete" @checked($personnel->hasPermissionTo('formation_delete'))> Supprimer
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                        <b>Examens</b>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="exam_view" @checked($personnel->hasPermissionTo('exam_view'))> Voir
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="exam_add" @checked($personnel->hasPermissionTo('exam_add'))> Ajouter
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="exam_edit" @checked($personnel->hasPermissionTo('exam_edit'))> Modifier
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="exam_delete" @checked($personnel->hasPermissionTo('exam_delete'))> Supprimer
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <b>Inscription</b>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="inscription_view" @checked($personnel->hasPermissionTo('inscription_view'))> Voir
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="inscription_add" @checked($personnel->hasPermissionTo('inscription_add'))> Ajouter
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="inscription_edit" @checked($personnel->hasPermissionTo('inscription_edit'))> Modifier
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="inscription_delete" @checked($personnel->hasPermissionTo('inscription_delete'))> Supprimer
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <b>Actualités</b>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="blog_view" @checked($personnel->hasPermissionTo('blog_view'))> Voir
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="blog_add" @checked($personnel->hasPermissionTo('blog_add'))> Ajouter
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="blog_edit" @checked($personnel->hasPermissionTo('blog_edit'))> Modifier
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="blog_delete" @checked($personnel->hasPermissionTo('blog_delete'))> Supprimer
                                    </td>
                                </tr>

                                 <tr>
                                    <td>
                                        <b>commentaires</b>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="comment_view" @checked($personnel->hasPermissionTo('comment_view'))> Voir
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="comment_add" @checked($personnel->hasPermissionTo('comment_add'))> Ajouter
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="comment_edit" @checked($personnel->hasPermissionTo('comment_edit'))> Modifier
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="comment_delete" @checked($personnel->hasPermissionTo('comment_delete'))> Supprimer
                                    </td>
                                </tr>
                               
                                <tr>


                                    <td>
                                        <b>Paramètres</b>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="setting_view" @checked($personnel->hasPermissionTo('setting_view'))> Voir
                                    </td>
                                    <td colspan="3"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Mettre a jour les permissions
                        </button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
