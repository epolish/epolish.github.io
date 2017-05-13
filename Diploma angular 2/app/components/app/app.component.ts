// Определение компонента app.component

// импорт декоратора Component из модуля @angular/core
import { Component } from '@angular/core';

import { DataService } from "../../services/data.service";
import { MathService } from "../../services/math.service";
import { Quest } from '../../classes/Quest';
// Применение декоратора Component для класса AppComponent
// Декоратор используется для присвоения метаданных для класса AppComponent
@Component({
    moduleId: module.id,
    selector: 'app',                       // Селектор, который определяет какой элемент DOM дерева будет представлять компонент.
    styleUrls: [ 'app.component.css' ],
    templateUrl: 'app.component.html', // HTML разметка определяющая представление текущего компонента
    providers: [ DataService, MathService ], // данный компонент использует экземпляр сервиса
})
export class AppComponent { 
    
    private quest: Quest;
    private income: number;
    private currenLost: number;
    private currentProfit: number;
    private monthPrice: number;
    private domenPrice: number;
    private hostingPrice: number;
    private warPercent: number;
    private helpPercent: number;
    private neutralityPercent: number;
    private saddlePoint: number;
    private graphicSolution: Array<number>;
    private labelA: Array<string>;
    private labelB: Array<string>;
    private questCollection: Array<Quest>;
    private strategies: Array<Array<number>>;
    private payMatrix: Array<Array<number>>;
    private newPayMatrix: Array<Array<number>>;
    private tempMatrix: Array<Array<number>>;

    constructor(private dataService: DataService, private mathService: MathService) {
        
        this.income = 300;
        this.monthPrice = 8400;
        this.domenPrice = 299;
        this.hostingPrice = 123;
        this.warPercent = 30;
        this.helpPercent = 15;
        this.neutralityPercent = 10;
        this.strategies = null;
        this.newPayMatrix = null;
        this.tempMatrix = null;
        this.graphicSolution = null; 
        this.questCollection = this.dataService.getData();
        this.quest = this.questCollection[0];
        this.labelA = ['Выходить на рынок', 'Не выходить на рынок'];
        this.labelB = ['Помогает',  'Нейтральна', 'Мешает'];
        
        return ;
    }
    
    transposeMatrix(matrix: Array<Array<number>>): Array<Array<number>> {
        
        return matrix[0].map((value: number, index: number) => 
            matrix.map((row: Array<number>) => row[index])
        );
    }
    
    getResult(): void {

        this.strategies = null;
        this.newPayMatrix = null;
        this.tempMatrix = null;
        this.saddlePoint = this.mathService.getData(this.payMatrix.slice(0));
        this.saddlePoint = parseFloat(this.saddlePoint.toFixed(2));

        if (this.mathService.compactMatrix.length !== 0) {
            this.newPayMatrix = this.mathService.compactMatrix;
        }
        if (this.mathService.robinsonSolution.length !== 0) {
            this.strategies = this.mathService.robinsonSolution;
            this.tempMatrix = this.transposeMatrix(this.payMatrix.slice(0));
        }
        if (this.mathService.graphicSolution.length !== 0) {
            this.graphicSolution = this.mathService.graphicSolution;
            console.log(this.graphicSolution);
        }
        
        return ;
    }
    
    ngDoCheck(): void {
        
        this.currentProfit = this.quest.count*this.income - (this.domenPrice/12) -this.hostingPrice;
        this.currenLost = (this.domenPrice/12) - this.hostingPrice;
        this.payMatrix = [
            [
                Math.round(this.currentProfit - this.currentProfit*this.helpPercent/100 - this.monthPrice),
                Math.round(this.currentProfit - this.currentProfit*this.neutralityPercent/100 - this.monthPrice),
                Math.round(this.currentProfit - this.currentProfit*this.warPercent/100 - this.monthPrice)
            ],
            [
                Math.round(this.currenLost - this.currenLost*this.helpPercent/100 - this.monthPrice),
                Math.round(this.currenLost - this.currenLost*this.neutralityPercent/100 - this.monthPrice),
                Math.round(this.currenLost - this.currenLost*this.warPercent/100 - this.monthPrice)
            ]
        ];

        return ;
    }

}
