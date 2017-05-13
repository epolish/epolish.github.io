export class Quest
{   
    private _city: string;
    private _count: number;

    constructor(city: string, count: number) { 
        
        this._city = city;
        this._count = count;
        
        return ;
    }
    
    get city(): string { 
        
        return this._city; 
    }
    
    set city(city: string) { 
        
        this._city = city;
        
        return ; 
    }
    
    get count(): number { 
    
        return this._count; 
    }
    
    set count(count: number) { 
    
        this._count = count; 
        
        return ; 
    }
    
}