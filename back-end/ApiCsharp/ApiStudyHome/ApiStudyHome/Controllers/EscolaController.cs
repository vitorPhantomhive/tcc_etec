using ApiStudyHome.Context;
using ApiStudyHome.Models;
using Microsoft.AspNetCore.Http.HttpResults;
using Microsoft.AspNetCore.Mvc;

namespace ApiStudyHome.Controllers

{
    [ApiController]
    [Route("[controller]")]
    public class EscolaController : ControllerBase
    {

        private readonly AppDbContext _context;
        public EscolaController(AppDbContext context)
        {
            _context = context;
        }

        [HttpGet]
        public ActionResult<IEnumerable<Escola>> Get()
        {
            var escolas = _context.Escolas.ToList();
            if(escolas is null || escolas.Count == 0)
            {
                return NotFound();
            }
            return escolas;
        }

        [HttpGet("{id}")]
        public ActionResult<IEnumerable<Escola>> GetById(int id)
        {
            var escolas = _context.Escolas.SingleOrDefault(d => d.Id == id);
            if (escolas is null)
            {
                return NotFound();
            }
            return Ok(escolas);
        }

        [HttpPost]
        public ActionResult Post(Escola escola)
        {   
            if(escola is null)
            {
                return BadRequest();
            }
            _context.Escolas.Add(escola);
            _context.SaveChanges();
            return Ok();
        }

        [HttpPut("{id}")]
        public ActionResult Put(int id, Escola escola)
        {
            var escolas = _context.Escolas.SingleOrDefault(escola => escola.Id == id);

            if(escolas is null)
            {
                return NotFound();
            }

            escolas.Update(escola.Nome, escola.CNPJ, escola.Email, escola.Senha);
            _context.SaveChanges();
            return Ok(escolas);

        }

        [HttpDelete("{id}")]
        public ActionResult Delete(int id)
        {
            var escola = _context.Escolas.Find(id); //pegando escola que tenha o id informado
            
            if(escola == null)
            {
                //Retorna não encontrou a escola
                return NoContent();
            }

            _context.Escolas.Remove(escola); // Marca a escola para exclusão
            _context.SaveChanges();

            return Ok();

        }

    }
}
