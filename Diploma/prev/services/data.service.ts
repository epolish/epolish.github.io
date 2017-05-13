import { Injectable } from "@angular/core";
import { Quest } from '../classes/Quest';

@Injectable()
export class DataService {
    
    private data: Quest[];

    constructor() {
        
        this.data = this.setData();
        
        return ;
    }
    
    getData(): Quest[] {
        
        return this.data;
    }
    
    setData(): Quest[] {
        
        return [
            new Quest('Киев', 100),
            new Quest('Одесса', 200),
            new Quest('Харьков', 150),
            new Quest('Львов', 150),
            new Quest('Днепропетровск', 300)
        ];
    }
    
}