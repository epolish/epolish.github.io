import { Injectable } from "@angular/core";
import { SimpleMethod } from "../classes/SimpleMethod";
import { RobinsonMethod } from "../classes/RobinsonMethod";

@Injectable()
export class MathService {

    private _testData: Array<Array<Array<number>>> = [
        [[13, 14, 15],[9, 10, 11],[13, 14, 15],[5, 6, 7],[1, 2, 3]],
        [[2, 2],[0, 4],[1, 6],[3, 7]],
        [[1, 2, 3],[4, 5, 6],[7, 8, 9]],
        [[5, 3],[2, 4]],
        [[4, 6],[7, 9]]
    ];
    
    constructor() { 
    
        return ;
    }
            
    getData(matrix: Array<Array<number>>): Array<Array<Array<number>>> | number {

        //matrix = this._testData[3].slice(0);
        let gamePrice: number = SimpleMethod.solve(matrix);

        if (!gamePrice) {
            let tempMatrix: Array<Array<number>> = SimpleMethod.compactMatrix(matrix),
                tempString: string = (',' + tempMatrix.toString() + ','),
                findInString: number;
            
            matrix = RobinsonMethod.solve(tempMatrix);
            findInString = tempString.indexOf(',' + RobinsonMethod.gamePrice + ',');

            if(findInString !== -1) {
                return RobinsonMethod.gamePrice;
            }
            matrix.unshift([RobinsonMethod.gamePrice]);
            
            return [matrix, tempMatrix];
        }
        
        return gamePrice;
    }
    
}