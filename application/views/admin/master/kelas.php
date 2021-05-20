  <div class="page-inner">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
                <button class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah</button>
            </div>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-sm" id="kelas">
              <thead>
                <tr>
                  <th scope="col">Kode Kelas</th>
                  <th scope="col">Nama Kelas</th>
                  <th scope="col">Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($kelas as $k): ?>
                  <tr>
                    <td><?=$k['kode_kelas']?></td>
                    <td><?=$k['nama_kelas']?></td>
                    <td>
                      <div class="form-button-action">
                        <button type="button" data-toggle="modal" 
                          onclick="editClick(`<?=$k['kode_kelas']?>`,`<?=$k['nama_kelas']?>`)" 
                          data-target="#edit"  
                          class="btn btn-link btn-primary btn-lg">
                          <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" onclick="deleteKelas(`<?=$k['kode_kelas']?>`)" data-toggle="tooltip" title="hapus kelas" class="btn btn-link btn-danger" data-original-title="Remove">
                          <i class="fa fa-times"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>      
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
       