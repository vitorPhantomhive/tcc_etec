import Fastify from "fastify";

import Cors from "@fastify/cors";
import { routes } from "./routes";

const app = Fastify({ logger: true });

const start = async () => {

    await app.register(Cors);
    await app.register(routes);

    try {
        await app.listen({
            port: 3333
        })
    } catch (error) {
        process.exit(1);
    }
}


start();