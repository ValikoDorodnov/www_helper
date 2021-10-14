export default class Gun {
    private ammo: number;

    constructor({ammo}: { ammo: number }) {
        this.ammo = ammo;
    }

    fire() {
        if (this.ammo > 0) {
            console.log('FIRE');
            this.ammo--;
        } else {
            console.log('NEED RELOAD');
        }
    }

    reload({ammo}: { ammo: number }) {
        if (ammo > 0) {
            this.ammo = ammo;
            console.log('RELOADED');
        } else {
            console.log('CANT RELOAD BELOW ZERO');
        }
    }
}