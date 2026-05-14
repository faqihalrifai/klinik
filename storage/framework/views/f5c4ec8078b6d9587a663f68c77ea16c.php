<?php $__env->startSection('title', 'Jadwal Konsultasi'); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="mb-0">Jadwal Konsultasi</h2>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="<?php echo e(route('jadwal.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?php echo e(route('jadwal.index')); ?>" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari pasien, dokter, atau keluhan..." value="<?php echo e($search); ?>">
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
                        <th>Tanggal & Jam</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $jadwals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($jadwals->firstItem() + $index); ?></td>
                            <td>
                                <strong><?php echo e(\Carbon\Carbon::parse($j->tanggal)->format('d M Y')); ?></strong><br>
                                <small class="text-muted"><i class="far fa-clock"></i> <?php echo e(\Carbon\Carbon::parse($j->jam)->format('H:i')); ?></small>
                            </td>
                            <td><?php echo e($j->pasien->nama); ?></td>
                            <td><?php echo e($j->dokter->nama); ?> <br><span class="badge bg-info text-dark" style="font-size: 0.7em;"><?php echo e($j->dokter->spesialis); ?></span></td>
                            <td><?php echo e(Str::limit($j->keluhan, 30) ?? '-'); ?></td>
                            <td>
                                <?php if($j->status == 'menunggu'): ?>
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                <?php elseif($j->status == 'proses'): ?>
                                    <span class="badge bg-primary">Proses</span>
                                <?php elseif($j->status == 'selesai'): ?>
                                    <span class="badge bg-success">Selesai</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Batal</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('jadwal.edit', $j->id)); ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('jadwal.destroy', $j->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal konsultasi ini?');" style="display:inline;">
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
                            <td colspan="7" class="text-center">Tidak ada data jadwal konsultasi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <?php echo e($jadwals->links('pagination::bootstrap-5')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\simklinik\resources\views/jadwal/index.blade.php ENDPATH**/ ?>