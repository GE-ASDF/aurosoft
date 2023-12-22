import Evento from "./classes/Evento.js";

const containerSubmenu = Evento.$el("#container-submenu").getElement();

const removeActiveFromOthers = ()=>{
    containerSubmenu.querySelectorAll(".submenu").forEach(item => {
        if(item.classList.contains("active")){
            item.classList.remove("active");
        }
    })
}

const handleSubmenuOpen = (e)=>{
    removeActiveFromOthers();

    const target = e.target.dataset.submenu;
    const object = document.querySelector(target);
    containerSubmenu.style.display = "block";
    
    if(!object.classList.contains("active")){
        object.classList.add("active");
    }
                            
}

const handleSubmenuclose = (e = '')=>{
    if(e){
        e.preventDefault();
    }
    containerSubmenu.style.display = "none";
}

const handleClickOutsideOfContainerMenu = (e)=>{
    if(!e.target.classList.contains("nav-menu-item")){
        if(e.target.closest("#container-submenu") == null){
            handleSubmenuclose();
        }
    }
}

Evento.$el("#main-content").click(handleClickOutsideOfContainerMenu);
Evento.$el("#btn-close-submenu-container").click(handleSubmenuclose)
Evento.$el(".nav-menu-item.nav-submenu-item").click(handleSubmenuOpen);