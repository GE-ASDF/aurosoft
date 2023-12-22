class Evento{
    
    /**
     * Retorna o elemento HTML selecionado pelo método $el
     * @returns o elemento HTML selecionado
     */
    getElement(){
        if(!this.el) console.error("Não há nenhum elemento selecionado.");
        return this.el; 
    }

    /**
     * Seleciona um ou mais elementos HTML
     * @param {string} el 
     * @returns this
     */
    $el(el){
        if(el.startsWith(".")){
            this.el = document.querySelectorAll(el);
        }else{
            this.el = document.querySelector(el);
        }
        return this;
    }
    /**
     * Adiciona um evento de clique a um ou vários elementos HTML
     * @param {function} callback 
     * @return this;
     */
    click(callback){
        if(typeof callback != 'function') console.error("Um callback válido deve ser informado. Ele deve ser uma função.")
        if(this.el instanceof NodeList || this.el instanceof Array){
            this.el.forEach(item => {
                item.addEventListener("click", callback)
            })
        }else{
            if(this.el instanceof HTMLElement){
                this.el.addEventListener("click", callback)
            }
        }
        return this;
    }


}


export default new Evento;

