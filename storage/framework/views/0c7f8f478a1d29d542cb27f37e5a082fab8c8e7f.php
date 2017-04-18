<?php $__env->startSection('content'); ?> 
<?php echo $__env->make('packages::partials.main-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- Left side column. contains the logo and sidebar -->
<?php echo $__env->make('packages::partials.main-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
    <?php echo $__env->make('packages::partials.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="panel panel-cascade">
                        <div class="panel-body ">
                            <div class="row">
                                <div class="box">
                                    <div class="box-header">
                                        <form action="<?php echo e(route('category')); ?>" method="get">
                                           
                                            <div class="col-md-3">
                                                <input value="<?php echo e((isset($_REQUEST['search']))?$_REQUEST['search']:''); ?>" placeholder="search by category" type="text" name="search" id="search" class="form-control" >
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" value="Search" class="btn btn-primary form-control">
                                            </div>
                                           
                                        </form>
                                         <div class="col-md-2">
                                             <a href="<?php echo e(route('category')); ?>">   <input type="submit" value="Reset" class="btn btn-default form-control"> </a>
                                        </div>
                                        <div class="col-md-2 pull-right">
                                            <div style="width: 150px;" class="input-group"> 
                                                <a href="<?php echo e(route('category.create')); ?>">
                                                    <button class="btn  btn-primary"><i class="fa fa-user-plus"></i> Create Category</button> 
                                                </a>
                                            </div>
                                        </div> 
                                    </div><!-- /.box-header -->

                                    
                                    <?php if(Session::has('flash_alert_notice')): ?>
                                         <div class="alert alert-success alert-dismissable" style="margin:10px">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                          <i class="icon fa fa-check"></i>  
                                         <?php echo e(Session::get('flash_alert_notice')); ?> 
                                         </div>
                                    <?php endif; ?>
                                      
                                   <div class="box-body table-responsive no-padding" >
                                        <table class="table table-hover table-condensed">
                                            <thead><tr>
                                                    <th>Sno</th> 
                                                    <th>Category Name</th>
                                                    <th>Sub Category Name</th>
                                                    <th>Created Date</th> 
                                                    <th>Action</th>
                                                </tr>
                                                <?php if(count($categories )==0): ?>
                                                    <tr>
                                                      <td colspan="7">
                                                        <div class="alert alert-danger alert-dismissable">
                                                          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                          <i class="icon fa fa-check"></i>  
                                                          <?php echo e('Record not found. Try again !'); ?>

                                                        </div>
                                                      </td>
                                                    </tr>
                                                  <?php endif; ?>
                                                <?php foreach($categories  as $key => $result): ?>  
                                             <thead>
                                              <tbody>    
                                                <tr>
                                                    <td><?php echo e(++$key); ?></td>
                                                    <td><?php echo e($result->category_name); ?></td>
                                                    <td><?php echo e($result->sub_category_name); ?></td>
                                                    
                                                    <td>
                                                        <?php echo Carbon\Carbon::parse($result->created_at)->format('m-d-Y H:i:s A');; ?>

                                                    </td>
                                                    
                                                    <td> 
                                                        <a href="<?php echo e(route('sub-category.edit',$result->id)); ?>">
                                                            <i class="fa fa-fw fa-pencil-square-o" title="edit"></i> 
                                                        </a>

                                                        <?php echo Form::open(array('class' => 'form-inline pull-left deletion-form', 'method' => 'DELETE',  'id'=>'deleteForm_'.$result->id, 'route' => array('category.destroy', $result->id))); ?>

                                                        <button class='delbtn btn btn-danger btn-xs' type="submit" name="remove_levels" value="delete" id="<?php echo e($result->id); ?>"><i class="fa fa-fw fa-trash" title="Delete"></i></button>
                                                        
                                                         <?php echo Form::close(); ?>


                                                    </td>
                                                </tr>
                                                <?php endforeach; ?> 
                                            </tbody></table>
                                    </div><!-- /.box-body --> 
                                    <div class="center" align="center">  <?php echo $categories->appends(['search' => isset($_GET['search'])?$_GET['search']:''])->render(); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div> 
        <!-- Main row --> 
    </section><!-- /.content -->
</div> 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('packages::layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>