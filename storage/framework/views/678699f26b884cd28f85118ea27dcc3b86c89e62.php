<?php $__env->startSection('title', 'Profile'); ?>

<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
    </div>
<?php endif; ?>



<?php $__env->startSection('content'); ?>
    <table>
        <?php echo e(Form::open(array('action' => 'CenterController@editProfile'))); ?>


        
        <tr><th colspan = "2">Unchangeable</th></tr>

        
        <tr>
            <td>Center ID:</td>
            <td><?php echo e(isset($center['cid']) ? $center['cid'] : "Center ID not found"); ?></td>
        </tr>

        <tr><th colspan = "2"><hr>General Info</th></tr>

        <tr>
            <td>Name:</td>
            <td><?php echo e(isset($center['name']) ? $center['name'] : "Name not found"); ?></td>
        </tr>

        <tr>
            <td>Description:</td>
            <td><?php echo e(isset($center['description']) ? $center['description'] : "Description not found"); ?></td>
        </tr>

        <tr>
            <td>Online Exam Support:</td>
            <td><?php echo e(isset($center['canSupportOnlineExam']) ? $center['canSupportOnlineExam'] : "Online support not found"); ?></td>
        </tr>

        <tr>
            <td>Exam Cost:</td>
            <td><?php echo e(isset($center['cost']) ? $center['cost'] : "Exam cost not found"); ?></td>
        </tr>

        <tr><th colspan = "2"><hr>Contact</th></tr>

        <tr>
            <td>Phone Number:</td>
            <td><?php echo e(isset($center['phone']) ? $center['phone'] : "Phone number not found"); ?></td>
        </tr>

        <tr>
            <td>Email:</td>
            <td><?php echo e(isset($center['email']) ? $center['email'] : "Email not found"); ?></td>
        </tr>

        <tr>
            <td>Website:</td>
            <td><?php echo e(isset($center['website']) ? $center['website'] : "Website not found"); ?></td>
        </tr>

        <tr><th colspan = "2"><hr>Address</th></tr>

        <tr>
            <td>Street Address:</td>
            <td><?php echo e(isset($center['street_name']) ? $center['street_name'] : "Street address not found"); ?></td>
        </tr>

        <tr>
            <td>City:</td>
            <td><?php echo e(isset($center['city']) ? $center['city'] : "City not found"); ?></td>
        </tr>

        <tr>
            <td>Province:</td>
            <td><?php echo e(isset($center['province']) ? $center['province'] : "Province not found"); ?></td>
        </tr>

        <tr>
            <td>Country:</td>
            <td><?php echo e(isset($center['country']) ? $center['country'] : "Country not found"); ?></td>
        </tr>

        <tr>
            <td>Postal Code:</td>
            <td><?php echo e(""); ?></td>
        </tr>

        
        <tr>
            <td>Longitude:</td>
            <td><?php echo e(""); ?></td>
        </tr>

        
        <tr>
            <td>Latitude:</td>
            <td><?php echo e(""); ?></td>
        </tr>


        <tr>
            <td></td>
            <td><?php echo e(Form::submit('Edit')); ?></td>
        </tr>

        <?php echo e(Form::close()); ?>

    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>