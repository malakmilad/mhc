<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.Answers'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
    <h1>
      Answers
     </h1>
    <ol class="breadcrumb">
       <a href="<?php echo e(route('home')); ?>"  class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.control'); ?> <i class="fa fa-arrow-circle-left"></i></a>
  </ol>
 </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
<section class="content">
     <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
              <!--  <h5 class="card-title">  <?php echo app('translator')->getFromJson('home.add_new'); ?></h5>-->
                <div class="card-tools">
      
               <!-- <a href="<?php echo e(route('home')); ?>" class="btn btn-info btn-sm">  <?php echo app('translator')->getFromJson('home.back'); ?> <i class="fa fa-arrow-circle-left"></i></a>-->
              </div><!-- /. tools -->
            </div>
            <div class="box-body">
            <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger text-center">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <P><?php echo e($error); ?></P>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
            <?php endif; ?>
              <form action="<?php echo e(route('answer.store')); ?>" method="post">
              <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label><?php echo app('translator')->getFromJson('home.client'); ?></label>
                      <select name="customer_id"  required class="form-control customer_id" >
                      <option value="" disabled><?php echo app('translator')->getFromJson('home.client'); ?></option>
                      <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($client->id); ?>" ><?php echo e($client->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                  </div>
                  
                    <div class="col-6">
                      <div class="form-group">
                        <label>Operations</label>
                        <select name="operation_id"  required class="form-control operation_id" >
                            <option value="" disabled>Operation</option>
                            <?php $__currentLoopData = $operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($operation->id); ?>" ><?php echo e($operation->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                
                </div>  
                <div class="row">
                    <div class="col-6">
                    <div class="form-group">
                      <label>Questions</label>
                        <?php $i= 1;?>
                   <br>
                      <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <br>
                       <span> <?php echo e($i); ?></span>
                            <input type="text" class="form-control" name="<?php echo e('question_id'.$i); ?>" value="<?php echo e($question->question); ?>" required placeholder="Question" />
             
                       <!-- <span><?php echo e($question->question); ?></span>-->
                        <?php if($question->question_type=="True/False Question"): ?>
                         <!-- <input type="checkbox" id="answer" name="answer" value="1" >
                          <label for="answer">  Answer True or false</label><br>-->
                          <br>
                          <input type="radio" name="<?php echo e('answer_'.$i); ?>" value="0"> False
                          <input type="radio" name="<?php echo e('answer_'.$i); ?>" value="1"> True

                        <?php else: ?>
                          <div class="feedback">
                            <div class="rating">
                            <input class="star star-5" id="<?php echo e('star-5'.$i); ?>" type="radio" value="5" name="<?php echo e('answer_'.$i); ?>"/>
                            <label class="star star-5" for="<?php echo e('star-5'.$i); ?>"></label>
                            <input class="star star-4" id="<?php echo e('star-4'.$i); ?>" type="radio" value="4" name="<?php echo e('answer_'.$i); ?>"/>
                            <label class="star star-4" for="<?php echo e('star-4'.$i); ?>"></label>
                            <input class="star star-3" id="<?php echo e('star-3'.$i); ?>" type="radio" value="3" name="<?php echo e('answer_'.$i); ?>"/>
                            <label class="star star-3" for="<?php echo e('star-3'.$i); ?>"></label>
                            <input class="star star-2" id="<?php echo e('star-2'.$i); ?>" type="radio" value="2" name="<?php echo e('answer_'.$i); ?>"/>
                            <label class="star star-2" for="<?php echo e('star-2'.$i); ?>"></label>
                            <input class="star star-1" id="<?php echo e('star-1'.$i); ?>" type="radio" value="1" name="<?php echo e('answer_'.$i); ?>"/>
                            <label class="star star-1" for="<?php echo e('star-1'.$i); ?>"></label>
                            </div>
                          </div>
                        <?php endif; ?>
                        <br>
                          <?php $i++;?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <br><br>
                      <div class="col-12">
                        <div class="form-group">
                          <label>Notes</label>
                                <input type="text" class="form-control" name="notes"  required placeholder="Notes" />
                          </div>
                          </div>
                    </div>
                  </div>
                  </div>
            <div class="row"> 
              <div class="col-6"> 
                <div class="box-footer clearfix">
                  <button class="pull-left btn btn-default"><?php echo app('translator')->getFromJson('home.save'); ?> <i class="fa fa-plus"></i></button>
                </div>
              </div>
            </div>
        </div>
          <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
   
      </form>
     </div>
  </div>
 </section>
<script>
  $(document).on('change',".customer_id", function (e) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var myelement=this;
    var valueSelected = this.value;
    var element="";
    var customer_id=$("[name='customer_id']").val();
    $('.operation_id').find('option').remove().end();
    $('.operation_id').append(' <option value="0"  selected> Select Operation </option>');

    $.ajax({
        url: '/get_tasks',
        type: 'POST',
        data: { _token: CSRF_TOKEN,customer_id:valueSelected },
        dataType: 'JSON',
        success: function (data1)
        {
         // alert(data1.operations.id.length);
            for(j=0;j<data1.operations.length;j++)
            { 
                $('.operation_id').append('<option value="'+data1.operations[j]['id'] +'">'+data1.operations[j]['name']+'</option>"');
            }

        }
    });
    $('.operation_id').find('option[value="0"]').attr('selected');
   });

</script>
<style>
* { box-sizing: border-box; }

.container {
  background-image: url("https://www.toptal.com/designers/subtlepatterns/patterns/concrete-texture.png");
  display: flex;
  flex-wrap: wrap;
  height: 100vh;
  align-items: center;
  justify-content: center;
  padding: 0 20px;
}

.rating {
  display: flex;
  width: 100%;
  justify-content: center;
  overflow: hidden;
  flex-direction: row-reverse;
  height: 50px;
  position: relative;
}

.rating-0 {
  filter: grayscale(100%);
}

.rating > input {
  display: none;
}

.rating > label {
  cursor: pointer;
  width: 40px;
  height: 40px;
  margin-top: auto;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: center;
  background-size: 76%;
  transition: .3s;
}

.rating > input:checked ~ label,
.rating > input:checked ~ label ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}


.rating > input:not(:checked) ~ label:hover,
.rating > input:not(:checked) ~ label:hover ~ label {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}

.emoji-wrapper {
  width: 100%;
  text-align: center;
  height: 100px;
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 0;
}

.emoji-wrapper:before,
.emoji-wrapper:after{
  content: "";
  height: 15px;
  width: 100%;
  position: absolute;
  left: 0;
  z-index: 1;
}

.emoji-wrapper:before {
  top: 0;
  background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(255,255,255,1) 35%,rgba(255,255,255,0) 100%);
}

.emoji-wrapper:after{
  bottom: 0;
  background: linear-gradient(to top, rgba(255,255,255,1) 0%,rgba(255,255,255,1) 35%,rgba(255,255,255,0) 100%);
}

.emoji {
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: .3s;
}

.emoji > svg {
  margin: 15px 0; 
  width: 70px;
  height: 70px;
  flex-shrink: 0;
}

#rating-1:checked ~ .emoji-wrapper > .emoji { transform: translateY(-100px); }
#rating-2:checked ~ .emoji-wrapper > .emoji { transform: translateY(-200px); }
#rating-3:checked ~ .emoji-wrapper > .emoji { transform: translateY(-300px); }
#rating-4:checked ~ .emoji-wrapper > .emoji { transform: translateY(-400px); }
#rating-5:checked ~ .emoji-wrapper > .emoji { transform: translateY(-500px); }

.feedback {
  max-width: 360px;
  background-color: #fff;
  width: 100%;
  padding: 30px;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  align-items: center;
  box-shadow: 0 4px 30px rgba(0,0,0,.05);
}
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>