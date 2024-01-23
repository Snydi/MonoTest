<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                         <?php $__env->slot('title', null, []); ?> Клиенты <?php $__env->endSlot(); ?>
    <a href="/cars"> <button type="button" class="btn btn-success">На парковку</button> </a>
    <a href="/clients/create/"> <button type="button" class="btn btn-success">Добавить</button> </a>

<table class="table">

    <thead>
    <tr>
        <th scope="col">Клиент</th>
        <th scope="col">Авто</th>
        <th scope="col">Номер</th>
        <th> <button type="button" class="btn btn-primary">Редактировать</button> </th>
        <th> <button type="button" class="btn btn-danger">Удалить</button> </th>
    </tr>
    </thead>

    <tbody>
    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td> <?php echo e($client->name); ?></td>
        <td> <?php echo e($client->brand); ?></td>
        <td> <?php echo e($client->plate); ?></td>
        <td>
            <a href="/clients/edit/<?php echo e($client->id); ?>">
                <button type="button" class="btn btn-primary">Редактировать</button>
            </a>
        </td>
        <td>
            <form action="<?php echo e(url('clients/delete', ['id' => $client->id])); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-danger" type="submit">Удалить</button>
            </form>
        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </tbody>

</table>
    <div class="d-flex">
        <?php echo $clients->links(); ?>

    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\MonoTest\server\resources\views/client/index.blade.php ENDPATH**/ ?>