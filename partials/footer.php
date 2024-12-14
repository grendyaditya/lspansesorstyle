   </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center py-4">
    <p>&copy; <?= date("Y"); ?> Inventory Management System. All rights reserved.</p>
</footer>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script>
    // Add active class based on the current page
    const currentLocation = window.location.pathname.split("/").pop();
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href') === currentLocation) {
            link.classList.add('active');
        }
    });
</script>

</body>
</html>