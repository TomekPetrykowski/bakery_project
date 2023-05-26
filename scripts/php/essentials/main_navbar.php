<?php 
    $user_url = substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/') + 1);

?>  



<header>
    <div class="logo">
        <a href="<?php if(!empty($index_url)) echo $index_url; ?>" class="logo-text">Rogaliki<br />Twardowskiego</a>
    </div>
    <div class="search">
        <form action="<?php if(!empty($search_url)) echo $search_url; ?>" method="get">
            <input type="text" name="search" placeholder="Wyszukaj produkt" autocomplete="on" />
            <button type="submit" name="search_submit"><i class="icon-search"></i></button>
        </form>
    </div>
    <nav>
        <ul>
            <li class="nav-li"><a class="nav-links" href="<?php if(!empty($index_url)) echo $index_url; ?>">Strona główna</a></li>
            <li class="nav-li"><a class="nav-links" href="<?php if(!empty($products_url)) echo $products_url; ?>">Produkty</a></li>
            <li class="nav-li"><a class="nav-links" href="<?php if(!empty($contact_url)) echo $contact_url; ?>">Kontakt</a></li>

            <?php if (!isset($_SESSION['is_logged_in'])): ?>
                <li class="log-in">
                    <span class="nav-links">
                        <a class="main-btn" href="<?php if(!empty($login_url)) echo $login_url; ?>">Zaloguj się</a>
                        <div class="reg-link-wrapper">
                            <h2 class="text-header reg-text">Nie masz konta? Zajerestruj się!</h2>
                            <a class="reg-link main-btn" href="<?php if(!empty($registration_url)) echo $registration_url; ?>">Rejestracja</a>
                        </div>
                    </span>
                </li>
            <?php else: ?>
                <?php if($user_url == '/projekt/scripts/php/user/'): ?>
                     <li class="log-in"><a class="main-btn" href="<?php if(!empty($logout_url)) echo $logout_url; ?>">Wyloguj się</a></li>
                <?php else: ?>
                    <li class="log-in">
                        <a href="<?php if(!empty($account_url)) echo $account_url; ?>" class="main-btn">
                            <span>Konto</span>
                            <i class="icon-user"></i>
                        </a>
                    </li>
                <?php endif ?>
                <li class="spaced-btn">
                    <a href="<?php if(!empty($basket_url)) echo $basket_url; ?>" class="main-btn" title="Koszyk">
                        <i class="icon-basket"></i>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</header>