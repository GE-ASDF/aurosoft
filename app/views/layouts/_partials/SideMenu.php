<div id="side-menu">
    <div id="menu">
        <div id="header-side-menu">
            <h1 class="text-white">Aurosoft</h1>
        </div>
        <div id="content-side-menu">
            <div id="header-content-profile-info">
                <div id="img-profile">
                    <img src="https://fastly.picsum.photos/id/281/200/300.jpg?hmac=KCN8F5QTgxHdeQxLpZ5BOuUEVQEp8jAedlLSRERW7CY" alt="imagem de perfil">
                </div>
                <div id="header-profile-info-user">
                    <div>
                        <span>Zé da manga</span>
                    </div>
                    <a href="#" class="nav-link"><i class="bi bi-person"></i> Editar perfil</a>
                </div>
            </div>
            <div id="header-menu-items">
                <?php 
                    component("LinkNavMenuItem", 
                        [
                            'text' => 'Dashboard', 
                            'active' => isset($active) && in_array("dashboard", $active) ? 'active':'', 
                            'link' => '', 
                            'icon' => 'bi-house'
                        ]);
                    component("NavMenuItem", 
                        [
                            'text' => 'Administrativo', 
                            'active' => isset($active) && in_array("administrativo", $active) ? 'active':'', 
                            'icon' => 'bi-kanban',
                            'id' => '#administrativo',
                        ]); 
                    component("NavMenuItem", 
                    [
                        'text' => 'Financeiro', 
                        'active' => isset($active) && in_array("financeiro", $active) ? 'active':'', 
                        'icon' => 'bi-cash-stack',
                        'id' => '#financeiro',
                    ]); 
                    
                ?>
                <div id="container-submenu" class="card p-0 text-bg-dark">
                    <div class="card-footer d-flex justify-content-start align-items-center">
                        <span id="btn-close-submenu-container" data-close="container-submenu" class="btn"><i class="bi text-white bi-arrow-left"></i></span>
                    </div>
                    <div class="card-body p-0">
                        <div id="administrativo" class="submenu">
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("alunos", $active) ? 'active':'', 'text' => 'Alunos', 'icon' => 'bi-person', 'link' => 'site/aluno']) ?>
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("responsaveis", $active) ? 'active':'', 'text' => 'Responsáveis', 'icon' => 'bi-person', 'link' => 'site/responsavel']) ?>
                        </div>
                        <div id="financeiro" class="submenu">
                            <p>Financeiro</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-side-menu" class="text-white fs-5 d-flex gap-2 align-items-center">
        <i class="bi bi-box-arrow-left"></i>
        <span>Sair</span>
    </div>
</div>

<script type="module" src="<?= asset("js/HandleSubMenu.js") ?>"></script>