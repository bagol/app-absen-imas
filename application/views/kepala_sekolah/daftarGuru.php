<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header"><h2>Daftar Guru</h2></div>
        <div class="card-body">
          <table class="table" id="tableGuru">
            <thead>
              <tr>
                <th>#</th>
                <td>NIP</td>
                <td>Nama</td>
                <td>Email</td>
                <td>Foto</td>
                <td>Satatus</td>
              </tr>
            </thead>
            <tbody>
              <?php if(!$guru){ ?>
                <tr>
                  <td class="text-center" colspan="6">Belum Ada Data</td>
                </tr>
              <?php } else{ $no=1; foreach ($guru as $g):?>
                <tr>
                  <td><?=$no++?></td>
                  <td><?=$g['nip']?></td>
                  <td><?=$g['nama_guru']?></td>
                  <td><?=$g['email_guru']?></td>
                  <td>
                    <div class="avatar avatar-xl">
                      <img src="<?=base_url('assets/images/profile/')?><?=$g['foto']?>" alt="Profile guru <?=$g['nip']?>" class="avatar-img rounded-circle">
                    </div>
                  </td>
                  <td><?=$g['status']?></td>
                </tr>
              <?php endforeach; } ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer">
          <a href="javascript:history.back()" class="btn- btn-sm btn-dark"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>