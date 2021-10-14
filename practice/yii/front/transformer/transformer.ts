import Gun from "./gun";
import Bike from "./bike";

export default class Transformer {
    private readonly name: string;
    private gun: Gun;
    private bike: Bike;

    constructor({name, gun, bike}: { name: string, gun: Gun, bike: Bike }) {
        this.name = name;
        this.gun = gun;
        this.bike = bike;
    }

    scream() {
        console.log(this.name);
    }

    fire() {
        this.gun.fire()
    }

    ride() {
        this.bike.ride()
    }
}