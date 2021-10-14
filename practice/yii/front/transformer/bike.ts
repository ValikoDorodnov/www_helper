export default class Bike {
    private readonly isFueled: boolean;

    constructor({isFueled}: { isFueled: boolean }) {
        this.isFueled = isFueled;
    }

    ride() {
        if (this.isFueled) {
            console.log('RIDE')
        } else {
            console.log('NEED FUEL')
        }
    }
}