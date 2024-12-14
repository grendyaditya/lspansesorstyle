<?php
include '../auth/auth.php';
checkAuth();
include '../config/db.php';

$title = "Edit Inventory";
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ambil ID inventory dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
    exit("<div class='alert alert-danger'>Invalid inventory ID.</div>");
}

// Ambil data inventory berdasarkan ID
$stmt = $conn->prepare("
    SELECT inventory.*, vendor.nama_barang 
    FROM inventory
    LEFT JOIN vendor ON inventory.vendor_id = vendor.id
    WHERE inventory.id = :id
");
$stmt->execute(['id' => $id]);
$inventory = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt->execute(['id' => $id]);
$inventory = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$inventory) {
    exit("<div class='alert alert-danger'>Inventory not found.</div>");
}

// Ambil data storage unit
$storage_units = $conn->query("SELECT id, nama_gudang FROM storage_unit")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $conn->prepare("UPDATE inventory SET jenis_barang = :jenis_barang, kuantitas_stok = :kuantitas_stok, 
                                storage_unit_id = :storage_unit_id, barcode = :barcode WHERE id = :id");
        $stmt->execute([
            'jenis_barang' => $_POST['jenis_barang'],
            'kuantitas_stok' => $_POST['kuantitas_stok'],
            'storage_unit_id' => $_POST['storage_unit_id'],
            'barcode' => $_POST['barcode'],
            'id' => $id
        ]);
        header("Location: inventory_list.php");
        exit();
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<?php include '../partials/header.php'; ?>
<?php include '../partials/sidebar.php'; ?>

<div class="container-fluid">
    <h1 class="mt-4">Edit Inventory</h1>

    <form method="POST">
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($inventory['nama_barang']); ?>" disabled>
        </div>

        <div class="form-group">
            <label>Jenis Barang</label>
            <input type="text" name="jenis_barang" class="form-control" required value="<?= htmlspecialchars($inventory['jenis_barang']); ?>">
        </div>

        <div class="form-group">
            <label>Kuantitas Stok</label>
            <input type="number" name="kuantitas_stok" class="form-control" required value="<?= htmlspecialchars($inventory['kuantitas_stok']); ?>">
        </div>

        <div class="form-group">
            <label>Lokasi Gudang</label>
            <select name="storage_unit_id" class="form-control" required>
                <?php foreach ($storage_units as $unit): ?>
                    <option value="<?= $unit['id']; ?>" <?= $unit['id'] == $inventory['storage_unit_id'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($unit['nama_gudang']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Barcode</label>
            <input type="text" name="barcode" class="form-control" required value="<?= htmlspecialchars($inventory['barcode']); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update Inventory</button>
    </form>
</div>

<?php include '../partials/footer.php'; ?>
