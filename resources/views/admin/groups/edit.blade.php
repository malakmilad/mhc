@extends('admin.layouts.master')
@section('pagetitle') @lang('home.group') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.group')
      <small>@lang('home.edit')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  @lang('home.control') </a></li>
      <li class="active"> @lang('home.edit')</li>
    </ol>
 </section>
@endsection
@section('main-content')
<section class="content">
  <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-edit"></i>
              <h3 class="box-title"> @lang('home.edit')</h3>
              <!-- tools box -->
              <div class="pull-left box-tools">
                <a href="{{ route('group.index',$menuid) }}" class="btn btn-info btn-sm">@lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
              </div><!-- /. tools -->
            </div>
            <div class="box-body">
            @if(count($errors) > 0)
                        <div class="alert alert-danger text-center">
                            @foreach($errors->all() as $error)
                                <P>{{ $error }}</P>
                            @endforeach
                        </div>
                        <div></div>
                    @endif
              <form action="{{ route('group.update',$group['id']) }}" method="post">
                {{ csrf_field() }}
              <input type="hidden" name="menuid" value="{{ $menuid }}">

                <div class="form-group">
                  <input type="text" class="form-control" name="name" value="{{ $group->name }}" placeholder="@lang('home.name')">
                </div>

                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">@lang('home.page')</th>
                      <th scope="col">@lang('home.permissions')</th>
                      <th scope="col">@lang('home.select_all') <input type="checkbox" onClick="setAllCheckboxes('actors', this);"> </th>
                    </tr>
                  </thead>
                  <tbody id="actors">
                      <?php $itrator = 0 ; ?>
                      @foreach($allmenus as $men)
                        <tr>
                          <?php $itrator = $itrator + 1 ;?>
                          <th scope="row">{{ $itrator }}</th>
                          <td>{{ $men->name_en }}</td>
                          <input type="hidden" name="menu_id{{ $itrator }}" value="{{ $men->id }}">
                          <td>
                            <div class="form-check" style="display: inline;">
                              <?php
                                $addcheck     = "";
                                $updatecheck  = "";
                                $deletecheck  = "";
                                $viewcheck  = "";
                              ?>
                              @foreach($group->permissions as $permiss)
                                @if($permiss['menu_id'] == $men['id'])
                                    <!-- add -->
                                  @if($permiss['add'] == 1)
                                     <?php $addcheck = "checked";?>
                                  @elseif($permiss['add'] == 0) 
                                  <?php $addcheck = "";?>
                                  @endif  
                                  <!-- end of add  -->

                                  <!-- view -->
                                  @if($permiss['view'] == 1)
                                     <?php $viewcheck = "checked";?>
                                  @elseif($permiss['view'] == 0) 
                                  <?php $viewcheck = "";?>
                                  @endif  
                                  <!-- end of view  -->

                                   <!-- update -->
                                  @if($permiss['update'] == 1)
                                     <?php $updatecheck = "checked";?>
                                  @elseif($permiss['add'] == 0) 
                                  <?php $updatecheck = "";?>
                                  @endif  
                                  <!-- end of update  -->

                                  <!-- update -->
                                  @if($permiss['delete'] == 1)
                                     <?php $deletecheck = "checked";?>
                                  @elseif($permiss['add'] == 0) 
                                  <?php $deletecheck = "";?>
                                  @endif  
                                  <!-- end of update  -->
                                @endif
                               @endforeach
                                <input class="form-check-input" type="checkbox" {{ $addcheck }} name="add{{ $itrator }}" value="1">
                                <label class="form-check-label">@lang('home.add')</label>
                            </div> |

                            <div class="form-check" style="display: inline;">
                            
                              <input class="form-check-input" type="checkbox" name="update{{ $itrator }}" {{ $updatecheck }} value="1">
                            <label class="form-check-label">@lang('home.edit')</label>
                          </div>|

                            <div class="form-check" style="display: inline;">
                            
                              <input class="form-check-input" type="checkbox" name="delete{{ $itrator }}" {{ $deletecheck }} value="1">
                            <label class="form-check-label">@lang('home.delete')</label>
                          </div>

                          |

                            <div class="form-check" style="display: inline;">
                            
                              <input class="form-check-input" type="checkbox" name="view{{ $itrator }}" {{ $viewcheck }} value="1">
                            <label class="form-check-label">@lang('home.view')</label>
                          </div>

                          </td>
                        </tr>
                        <?php
                          $addcheck     = "";
                          $updatecheck  = "";
                          $deletecheck  = "";
                          $viewcheck  = "";
                        ?>
                      @endforeach
                  </tbody>
                </table>

                <input type="hidden" name="itrator" id="itrator" value="{{ $itrator }}">
            </div>
            <div class="box-footer clearfix">
              <button class="pull-left btn btn-default">@lang('home.save') <i class="fa fa-plus"></i></button>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
 <script type="text/javascript">
   function setAllCheckboxes(divId, sourceCheckbox) {
    divElement = document.getElementById(divId);
    inputElements = divElement.getElementsByTagName('input');
    for (i = 0; i < inputElements.length; i++) {
        if (inputElements[i].type != 'checkbox')
            continue;
        inputElements[i].checked = sourceCheckbox.checked;
    }
}
 </script>
@endsection