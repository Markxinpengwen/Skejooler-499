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

<?php echo e(isset($input) ? $input : 'not found'); ?>


<?php $__env->startSection('content'); ?>
    <table>
    <?php echo e(Form::open(array('action' => 'CenterController@updateProfile'))); ?>


        
        <tr><th colspan = "2">Unchangeable</th></tr>

        
        <tr>
            <td><?php echo e(Form::label('cid', 'Center ID:')); ?></td>
            <td><?php echo e(Form::number('cid')); ?></td>
        </tr>

        <tr><th colspan = "2"><hr>General Info</th></tr>

        <tr>
            <td><?php echo e(Form::label('name', 'Name:')); ?></td>
            <td><?php echo e(Form::text('name')); ?></td>
        </tr>

        <tr>
            <td><?php echo e(Form::label('description', 'Description:')); ?></td>
            <td><?php echo e(Form::textarea('description')); ?></td>
        </tr>

        <tr>
            <td><?php echo e(Form::label('canSupportOnlineExam', 'Online Exam Support:')); ?></td>
            <td>Yes<?php echo e(Form::radio('canSupportOnlineExam-yes')); ?>

                No<?php echo e(Form::radio('canSupportOnlineExam-no')); ?></td>
        </tr>

        <tr>
            <td><?php echo e(Form::label('cost', 'Exam Cost:')); ?></td>
            <td><?php echo e(Form::text('cost')); ?></td>
        </tr>

        <tr><th colspan = "2"><hr>Contact</th></tr>

        <tr>
            <td><?php echo e(Form::label('phone', 'Phone Number:')); ?></td>
            <td><?php echo e(Form::text('phone')); ?></td>
        </tr>

        <tr>
            <td><?php echo e(Form::label('email', 'Email:')); ?></td>
            <td><?php echo e(Form::email('email')); ?></td>
        </tr>

        <tr>
            <td><?php echo e(Form::label('website', 'Website:')); ?></td>
            <td><?php echo e(Form::text('website')); ?></td>
        </tr>

        <tr><th colspan = "2"><hr>Address</th></tr>

        <tr>
            <td><?php echo e(Form::label('street_address', 'Street Address:')); ?></td>
            <td><?php echo e(Form::text('street_address')); ?></td>
        </tr>

        <tr>
            <td><?php echo e(Form::label('city', 'City:')); ?></td>
            <td><?php echo e(Form::text('city')); ?></td>
        </tr>

        <tr>
            <td><?php echo e(Form::label('province', 'Province:')); ?></td>
            <td><?php echo e(Form::select('province', array(
                'British_Columbia' => 'British Columbia',
                'Alberta' => 'Alberta',
                'Sasketchewan' => 'Sasketchewan',
                'Manitoba' => 'Manitoba',
                'Ontario' => 'Ontario',
                'Quebec' => 'Quebec',
                'Nova_Scotia' => 'Nova Scotia',
                'Newfoundland_and_Labrador' => 'Newfoundland and Labrador',
                'New_Brunswick' => 'New Brunswick',
                'Prince_Edward_Island' => 'Prince Edward Island',
                'Yukon' => 'Yukon',
                'Northwest_Territories' => 'Northwest Territories',
                'Nunavut' => 'Nunavut'
                ))); ?></td>
        </tr>

        <tr>
            <td><?php echo e(Form::label('country', 'Country:')); ?></td>
            <td><?php echo e(Form::select('country', array(
                'Canada' => 'Canada'
                ))); ?></td>
        </tr>

        <tr>
            <td><?php echo e(Form::label('', 'Postal Code:')); ?></td>
            <td><?php echo e(Form::text('')); ?></td>
        </tr>

        
        <tr>
            <td><?php echo e(Form::label('', 'Longitude:')); ?></td>
            <td><?php echo e(Form::text('')); ?></td>
        </tr>

        
        <tr>
            <td><?php echo e(Form::label('', 'Latitude:')); ?></td>
            <td><?php echo e(Form::text('')); ?></td>
        </tr>


        <tr>
            <td></td>
            <td><?php echo e(Form::submit('Submit')); ?></td>
        </tr>

    <?php echo e(Form::close()); ?>

    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>