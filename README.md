<h1>Inventory Management System</h1>
<p>Aplikasi berbasis PHP untuk mengelola inventaris. Aplikasi ini memungkinkan pengguna untuk menambah, mengubah, melihat, dan menghapus item inventaris, serta melacak stok barang masuk/keluar dan informasi supplier.</p>
<br>
<h3>Fitur</h3>
<ul>
  <li>Autentikasi pengguna dengan kontrol akses berbasis role (Admin, Staff, Viewer).</li>
  <li>Operasi CRUD untuk item inventaris.</li>
  <li>Manajemen stok barang masuk dan keluar.</li>
  <li>Pengelolaan data supplier dan kategori.</li>
  <li>Dashboard dengan grafik visual dan metrik utama.</li>
</ul>


<h3>How to Use</h3>
<ol>
  <li>Clone this repository</li>
  <li>import file db/inventaris(1).sql to your MySQL database</li>
  <li>Update the `functions/functions.php` file with your database credentials.</li>
  <li>Start a local PHP server</li>
</ol>

<h3>Role Access</h3>
<p>The default password for username admin is admin, and for username user is user</p>
<ul>
  <li><b>Admin:</b> Full access to all features.</li>
  <li><b>Staff:</b> Limited to item and stock management.</li>
  <li><b>Viewer (default):</b> Read-only access to inventory data.</li>
</ul>
