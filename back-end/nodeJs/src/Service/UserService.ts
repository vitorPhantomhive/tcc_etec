import prismaClient from "../prisma";


class UserService{
    async createUser(name: string, email: string){
        if(!name || !email) throw new Error("Preencha os dados obrigatorios");

        const user = await prismaClient.user.create({
            data: {
                name: name,
                email: email
            }
        });

        return user;

    }       

    async getUsers(){
        const users = await prismaClient.user.findMany();

        return users;
    }
}


export {UserService}