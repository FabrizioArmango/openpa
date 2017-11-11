let instance = null;

class Cache
{          
    constructor() {
        if(!instance)
        {
            instance = this;
            this.pageTitle = "Home";
            this.selectedFood = {};
            this.selectedCinema = {};
            this.selectedChurch = {};
        }

        return instance;
    }

    setNewFood(food)
    {
        this.selectedFood = food;        
        console.log("Settato "+ this.selectedFood.title + " in cache")
    }

    setNewCinema(cinema)
    {
        this.selectedCinema = cinema;
    }

    setNewChurch(church)
    {
        this.selectedChurch = church;
    }

    setNewTitle(title)
    {
        this.pageTitle = title;
    }
    
}
export default Cache;