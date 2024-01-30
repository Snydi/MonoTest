<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e($title); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>

    <link href="<?php echo e(asset('sass/app.scss')); ?>" rel="stylesheet">
</head>
<body>
<?php echo e($slot); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\MonoTest\server\resources\views/components/layout.blade.php ENDPATH**/ ?>