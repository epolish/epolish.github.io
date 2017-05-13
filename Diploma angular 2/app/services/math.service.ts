import { Injectable } from "@angular/core";
import { SimpleMethod } from "../classes/SimpleMethod";
import { RobinsonMethod } from "../classes/RobinsonMethod";
import { GraphicMethod } from "../classes/GraphicMethod";

@Injectable()
export class MathService {

    private _graphicSolution: Array<number>;
    private _compactMatrix: Array<Array<number>>;
    private _robinsonSolution: Array<Array<number>>;
    
    constructor() {      
        
        this._graphicSolution = new Array<number>();
        this._compactMatrix = new Array<Array<number>>();
        this._robinsonSolution = new Array<Array<number>>();
        
        return ;
    }
    
    get graphicSolution(): Array<number> { 
    
        return this._graphicSolution;
    }
    
    get compactMatrix(): Array< Array<number>> { 
    
        return this._compactMatrix;
    }
    
    get robinsonSolution(): Array< Array<number>> { 
    
        return this._robinsonSolution;
    }
    
    getData(matrix: Array<Array<number>>): number {

        let gamePrice: number = SimpleMethod.solve(matrix.slice(0)),
            tempString: string = '';

        if (!gamePrice) {
            this._compactMatrix = SimpleMethod.compactMatrix(matrix.slice(0));
            tempString = (',' + this._compactMatrix.toString() + ',');
            this._robinsonSolution = RobinsonMethod.solve(this._compactMatrix.slice(0));

            if(tempString.indexOf(',' + RobinsonMethod.gamePrice + ',') === -1) {
                try {
                    this._graphicSolution = GraphicMethod.solve(this._compactMatrix.slice(0));
                    if(!this._graphicSolution || !isFinite(this._graphicSolution[0])) {
                        throw new Error('Графический метод не применим для данной игры');
                    }
                } catch (exception) {
                    console.log(exception.message);
                } finally {
                    gamePrice = RobinsonMethod.gamePrice;
                }
            } else {
                this._compactMatrix = [];
                this._graphicSolution = [];
                this._robinsonSolution = [];
                gamePrice = RobinsonMethod.gamePrice;
            }
        }
        
        return gamePrice;
    }
}