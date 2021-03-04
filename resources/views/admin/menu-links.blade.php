<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-utensils"></i>
        <p>
            Mon menu
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="{{ route('admin.meals.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Plats</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.meal-categories.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Catégories de plat</p>
            </a>
        </li>

    </ul>
</li>

<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-utensils"></i>
        <p>
            Mes commandes
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="{{ route('admin.orders.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Commandes</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.orders.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ajouter une commande</p>
            </a>
        </li>
    </ul>
</li>
