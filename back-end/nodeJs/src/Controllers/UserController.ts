import { FastifyReply, FastifyRequest } from "fastify";
import { UserService } from '../Service/UserService';


class UserController {
    async handle(req: FastifyRequest, reply: FastifyReply) {

        const { name, email } = req.body as { name: string, email: string };

        const userService = new UserService();
        const user_created = userService.createUser(name, email);

        return user_created;
    }

    async getAll(req: FastifyRequest, reply: FastifyReply) {

        const userService = new UserService();
        const users = await userService.getUsers();

        reply.send(users);
    }
}



export { UserController }