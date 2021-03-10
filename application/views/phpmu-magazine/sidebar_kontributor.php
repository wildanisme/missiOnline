<div class="widget">
	<h3>tulisan Terbaru</h3>
	<div class="widget-articles">
		<ul>
			<li>
				<?php
				$terbaru = $this->model_utama->view_join_two('tulisan', 'users', 'kategori', 'username', 'id_kategori', array('tulisan.status' => 'Y'), 'id_tulisan', 'DESC', 0, 3);
				foreach ($terbaru->result_array() as $r2x) {
					$total_komentar = $this->model_utama->view_where('komentar', array('id_tulisan' => $r2x['id_tulisan']))->num_rows();
					echo "<li>
							<div class='article-photo'>";
					if ($r2x['gambar'] == '') {
						echo "<a href='" . base_url() . "$r2x[judul_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='" . base_url() . "asset/foto_tulisan/small_no-image.jpg' alt='' /></a>";
					} else {
						echo "<a href='" . base_url() . "$r2x[judul_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='" . base_url() . "asset/foto_tulisan/$r2x[gambar]' alt='' /></a>";
					}
					echo "</div>
							<div class='article-content'>
								<h4><a href='" . base_url() . "$r2x[judul_seo]'>$r2x[judul]</a><a href='" . base_url() . "$r2x[judul_seo]' class='h-comment'>$total_komentar</a></h4>
								<span class='meta'>
									<a href='" . base_url() . "$r2x[judul_seo]'><span class='icon-text'>&#128340;</span>$r2x[jam], " . tgl_indo($r2x['tanggal']) . "</a>
								</span>
							</div>
						  </li>";
				}
				?>
			</li>
		</ul>
	</div>
</div>

<div class="widget">
	<h3>tulisan Populer</h3>
	<div class="widget-articles">
		<ul>
			<li>
				<?php
				$populer = $this->model_utama->view_join_two('tulisan', 'users', 'kategori', 'username', 'id_kategori', array('tulisan.status' => 'Y'), 'dibaca', 'DESC', 0, 3);
				foreach ($populer->result_array() as $r2x) {
					$total_komentar = $this->model_utama->view_where('komentar', array('id_tulisan' => $r2x['id_tulisan']))->num_rows();
					echo "<li>
							<div class='article-photo'>";
					if ($r2x['gambar'] == '') {
						echo "<a href='" . base_url() . "$r2x[judul_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='" . base_url() . "asset/foto_tulisan/small_no-image.jpg' alt='' /></a>";
					} else {
						echo "<a href='" . base_url() . "$r2x[judul_seo]' class='hover-effect'><img style='width:59px; height:42px;' src='" . base_url() . "asset/foto_tulisan/$r2x[gambar]' alt='' /></a>";
					}
					echo "</div>
							<div class='article-content'>
								<h4><a href='" . base_url() . "$r2x[judul_seo]'>$r2x[judul]</a><a href='" . base_url() . "$r2x[judul_seo]' class='h-comment'>$total_komentar</a></h4>
								<span class='meta'>
									<a href='" . base_url() . "$r2x[judul_seo]'><span class='icon-text'>&#128340;</span>$r2x[jam], " . tgl_indo($r2x['tanggal']) . "</a>
								</span>
							</div>
						  </li>";
				}
				?>
			</li>
		</ul>
	</div>
</div>