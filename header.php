<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="dashboard.php">NFT Marketplace <i class="bi-bag"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="add_nft.php" title="Add Items"><i class="bi-plus-circle-fill"></i><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myitems.php"  title="My Items"><i class="bi-stack"></i><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="wallet.php"  title="Wallet"><i class="bi-wallet2"></i><span class="sr-only">(current)</span></a>
                </li>
            </ul>

            <div class="d-flex">
                <h5 class="navbar-brand">Welcome, <?php echo $displayName;  ?></h5>
                <a class="nav-link" href="logout.php"  title="Logout">Logout<i class="bi-indent"></i><span class="sr-only">(current)</span></a>
                
            </div>


        </div>
    </nav>