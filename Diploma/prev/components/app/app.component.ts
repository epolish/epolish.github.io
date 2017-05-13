// Определение компонента app.component

// импорт декоратора Component из модуля @angular/core
import { Component } from '@angular/core';

import { GraphicsComponent } from "../graphics/graphics.component"
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
    private labelA: Array<string>;
    private labelB: Array<string>;
    private questCollection: Array<Quest>;
    private strategies: Array<Array<number>>;
    private payMatrix: Array<Array<number>>;
    private newPayMatrix: Array<Array<number>>;
    private tempMatrix: Array<Array<number>>;
    private static DATA_MODIFIED = false;

    constructor(private dataService: DataService, private mathService: MathService) {
        
        this.income = 300;
        this.monthPrice = 8400;
        this.domenPrice = 299;
        this.hostingPrice = 123;
        this.warPercent = 30;
        this.helpPercent = 15;
        this.neutralityPercent = 10;      
        this.questCollection = this.dataService.getData();
        this.quest = this.questCollection[0];
        this.labelA = ['Выходит на рынок', 'Не выходит на рынок'];
        this.labelB = ['Помогает',  'Нейтральна', 'Мешает'];
        
        return ;
    }
    
    transposeMatrix(matrix: Array<Array<number>>): Array<Array<number>> {
        
        return matrix[0].map((value: number, index: number) => 
            matrix.map((row: Array<number>) => row[index])
        );
    }
    
    getResult(): void {

        let resultData: Array<Array<Array<number>>> | number = this.mathService.getData(this.payMatrix);
        
        if (typeof resultData === 'number') {
            this.saddlePoint = parseFloat(resultData.toFixed(2));
            this.strategies = null;
        } else {
            this.saddlePoint = parseFloat(resultData[0].splice(0, 1).pop().pop().toFixed(2));
            this.strategies = resultData[0];
            this.newPayMatrix = resultData[1];
            this.tempMatrix = this.transposeMatrix(this.payMatrix);
            AppComponent.DATA_MODIFIED = true;
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
               
        if(AppComponent.DATA_MODIFIED) {
            AppComponent.DATA_MODIFIED = false;
        } else {
            this.strategies = null;
            this.newPayMatrix = null;
            this.tempMatrix = null;
        }

        return ;
    }

} // Класс определяющий поведение компонента
