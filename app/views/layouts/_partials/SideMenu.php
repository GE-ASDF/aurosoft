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
                        'text' => 'Pedagógico', 
                        'active' => isset($active) && in_array("pedagogico", $active) ? 'active':'', 
                        'icon' => 'bi-person-video3',
                        'id' => '#pedagogico',
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
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("responsaveis", $active) ? 'active':'', 'text' => 'Responsáveis', 'icon' => 'bi-person', 'link' => '']) ?>
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("colaboradores", $active) ? 'active':'', 'text' => 'Colaboradores', 'icon' => 'bi-person-vcard', 'link' => '']) ?>
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("salasaula", $active) ? 'active':'', 'text' => 'Salas de aula', 'icon' => 'bi-person-workspace', 'link' => '']) ?>
                        </div>
                        <div id="financeiro" class="submenu">
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("recebimentos", $active) ? 'active':'', 'text' => 'Recebimentos', 'icon' => 'bi-piggy-bank', 'link' => '']) ?>
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("contasreceber", $active) ? 'active':'', 'text' => 'Contas a receber', 'icon' => 'bi-wallet2', 'link' => '']) ?>
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("inadimplentes", $active) ? 'active':'', 'text' => 'Inadimplentes', 'icon' => 'bi-cash', 'link' => '']) ?>
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("caixa", $active) ? 'active':'', 'text' => 'Relatório de caixa', 'icon' => 'bi-file-earmark-spreadsheet', 'link' => '']) ?>
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("movimentacaofinanceira", $active) ? 'active':'', 'text' => 'Moviment. financeira', 'icon' => 'bi-bank', 'link' => '']) ?>
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("auditoria", $active) ? 'active':'', 'text' => 'Auditoria', 'icon' => 'bi-shield-check', 'link' => '']) ?>
                        </div>
                        <div id="pedagogico" class="submenu">
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("presencasfaltas", $active) ? 'active':'', 'text' => 'Presenças e faltas', 'icon' => 'bi-person-raised-hand', 'link' => '']) ?>
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("presencasfaltas", $active) ? 'active':'', 'text' => 'Alunos em andamento', 'icon' => 'bi-pc-display', 'link' => '']) ?>
                            <?php component("LinkNavMenuItem", ['active' => isset($active) && in_array("presencasfaltas", $active) ? 'active':'', 'text' => 'Alunos concluídos', 'icon' => 'bi-check-all', 'link' => '']) ?>
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