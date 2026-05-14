<?php $__env->startSection('title', 'Data Dokter'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="mb-0">Data Dokter</h2>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="<?php echo e(route('dokter.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Dokter
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?php echo e(route('dokter.index')); ?>" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, spesialis, atau telp dokter..." value="<?php echo e($search); ?>">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Spesialis</th>
                        <th>Telp</th>
                        <th>Jadwal Praktik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $dokters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($dokters->firstItem() + $index); ?></td>
                            <td><?php echo e($d->nama); ?></td>
                            <td><span class="badge bg-info text-dark"><?php echo e($d->spesialis); ?></span></td>
                            <td><?php echo e($d->telp ?? '-'); ?></td>
                            <td><?php echo e(Str::limit($d->jadwal_praktik, 50) ?? '-'); ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('dokter.edit', $d->id)); ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('dokter.destroy', $d->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus data dokter ini?');" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data dokter.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <?php echo e($dokters->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\simklinik\resources\views/dokter/index.blade.php ENDPATH**/ ?>