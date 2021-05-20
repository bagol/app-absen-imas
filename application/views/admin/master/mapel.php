<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">
              <button class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah</button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Kode Mata Pelajaran</th>
                  <th>Mata Pelajaran</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php if($mapel === 0) {?>
                  <tr>
                    <td colspan="4" class="text-center">Belum Ada Data</td>
                  </tr>  
                <?php }else{ $no = 1; foreach($mapel as $mp): ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?=$mp['kode_mapel']?></td>
                    <td><?=$mp['nama_mapel']?></td>
                    <td>
                      <div class="form-button-action">
                        <button type="button" data-toggle="modal" 
                          data-target="#edit" onclick='editModal(<?= json_encode($mp)?>)'
                          class="btn btn-link btn-primary btn-lg">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" 
                          onclick="deleteMapel(`<?=$mp['kode_mapel']?>`,`<?=$mp['nama_mapel']?>`)" data-toggle="tooltip" 
                          title="hapus Mata Pelajaran" class="btn btn-link btn-danger" 
                          data-original-title="Remove">
                          <i class="fa fa-times"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  