export class FlashMessages{

    btnClose(){
        Array.from(document.getElementsByClassName("btn-close")).forEach(btn=>{
            btn.addEventListener("click", (e)=>{
                e.target.parentNode.remove();
            })
        })
        Array.from(document.getElementsByClassName("btn-close")).forEach(btn=>{
           setTimeout(() => {
             btn.parentNode.remove();
           }, 7000);
        })
    }

    static success(message){
        document.querySelector("#mensagem-informacional")
        .innerHTML += 
        `   
            <span style="transition: all 0.6s ease-in-out;" class="alert alert-success d-flex justify-content-between align-items-center">
                    ${message}
                <span class="btn mx-1  btn-close"></span>
            </span>
        `
        const flash = new FlashMessages();
        flash.btnClose();
    }

    static primary(message){
        document.querySelector("#mensagem-informacional")
        .innerHTML += 
        `   
            <span style="transition: all 0.6s ease-in-out;" class="alert alert-primary d-flex justify-content-between align-items-center">
                    ${message}
                <span class="btn mx-1  btn-close"></span>
            </span>
        `
        const flash = new FlashMessages();
        flash.btnClose();
    }
    
    static danger(message){
        document.querySelector("#mensagem-informacional")
        .innerHTML += 
        `   
            <span style="transition: all 0.6s ease-in-out;" class="alert alert-danger d-flex justify-content-between align-items-center">
                    ${message}
                <span class="btn mx-1 btn-close"></span>
            </span>
        `
        const flash = new FlashMessages();
        flash.btnClose();
    }

    static warning(message){
        document.querySelector("#mensagem-informacional")
        .innerHTML += 
        `   
            <span style="transition: all 0.6s ease-in-out;" class="alert alert-warning d-flex justify-content-between align-items-center">
                    ${message}
                <span class="btn mx-1  btn-close"></span>
            </span>
        `
        const flash = new FlashMessages();
        flash.btnClose();
    }
}