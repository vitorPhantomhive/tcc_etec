import { FastifyInstance, FastifyRequest, FastifyPluginOptions, FastifyReply } from "fastify";
import { UserController } from "./Controllers/UserController";


export async function routes(fastify: FastifyInstance, options: FastifyPluginOptions) {

    fastify.post("/user", async (req: FastifyRequest, reply: FastifyReply) => {
        return new UserController().handle(req, reply);
    });
    
    fastify.get("/user", async (req: FastifyRequest, reply: FastifyReply) => {
        return new UserController().getAll(req, reply);
    });
}

