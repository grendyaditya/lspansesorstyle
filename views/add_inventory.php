<?php
include '../auth/auth.php';
checkAuth();
include '../config/db.php';

$title = "Add Inventory";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$storage_units = $conn->query("SELECT id, nama_gudang FROM storage_unit")->fetchAll(PDO::FETCH_ASSOC);
$nama_barang = $_POST['nama_barang'] ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_inventory'])) {
        $vendor_id = $_POST['nama_barang']; // Nama_barang sekarang menyimpan vendor_id

        try {
            $stmt = $conn->prepare("INSERT INTO inventory (vendor_id, jenis_barang, kuantitas_stok, storage_unit_id, barcode) 
                                   VALUES (:vendor_id, :jenis_barang, :kuantitas_stok, :storage_unit_id, :barcode)");
            $stmt->execute([
                'vendor_id' => $vendor_id,
                'jenis_barang' => $_POST['jenis_barang'],
                'kuantitas_stok' => $_POST['kuantitas_stok'],
                'storage_unit_id' => $_POST['storage_unit_id'],
                'barcode' => $_POST['barcode']
            ]);

            // Redirect jika berhasil
            header("Location: inventory_list.php");
            exit();
        } catch (PDOException $e) {
            // Tampilkan pesan error jika terjadi kesalahan
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    }
}

$nama_barang_options = $conn->query(
    "SELECT vendor.id AS vendor_id, vendor.nama AS nama_vendor, vendor.nama_barang 
     FROM vendor"
)->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../partials/header.php'; ?>
<?php include '../partials/sidebar.php'; ?>

<div class="container-fluid">
    <h1 class="mt-4">Add Inventory</h1>

    <form method="POST">
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <select name="nama_barang" id="nama_barang" class="form-control" required>
                <option value="">Pilih Nama Barang</option>
                <?php foreach ($nama_barang_options as $option): ?>
                    <option value="<?= htmlspecialchars($option['vendor_id']); ?>" <?= $option['vendor_id'] == ($_POST['nama_barang'] ?? '') ? 'selected' : ''; ?> >
                        <?= htmlspecialchars($option['nama_barang']) . " - " . htmlspecialchars($option['nama_vendor']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="jenis_barang">Jenis Barang</label>
            <input type="text" name="jenis_barang" class="form-control" required value="<?= htmlspecialchars($_POST['jenis_barang'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="kuantitas_stok">Kuantitas Stok</label>
            <input type="number" name="kuantitas_stok" class="form-control" required value="<?= htmlspecialchars($_POST['kuantitas_stok'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="storage_unit_id">Lokasi Gudang</label>
            <select name="storage_unit_id" class="form-control" required>
                <?php foreach ($storage_units as $unit): ?>
                    <option value="<?= $unit['id']; ?>" <?= (isset($_POST['storage_unit_id']) && $_POST['storage_unit_id'] == $unit['id']) ? 'selected' : ''; ?> >
                        <?= htmlspecialchars($unit['nama_gudang']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="barcode">Barcode</label>
            <input type="text" name="barcode" class="form-control" required value="<?= htmlspecialchars($_POST['barcode'] ?? '') ?>">
        </div>

        <button type="submit" name="submit_inventory" class="btn btn-primary">Add Inventory</button>
    </form>
</div>

<?php include '../partials/footer.php'; ?>
