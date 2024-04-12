using ApiStudyHome.Context;
using ApiStudyHome.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace ApiStudyHome.Controllers
{
    [Route("[controller]")]
    [ApiController]
    public class AnotacoesController : ControllerBase
    {
        private readonly AppDbContext _context;
        public AnotacoesController(AppDbContext contenxt)
        {
            _context = contenxt;
        }

        [HttpGet]
        public ActionResult<IEnumerable<Anotacao>> Get()
        {
            var anotacoes = _context.Anotacoes.ToList();
            if (anotacoes is null || anotacoes.Count == 0)
            {
                return NotFound();
            }
            return anotacoes;
        }

        [HttpGet("{id}")]
        public ActionResult<IEnumerable<Anotacao>> GetById(int id)
        {
            var anotacoes = _context.Anotacoes.SingleOrDefault(d => d.Id == id);
            if (anotacoes is null)
            {
                return NotFound();
            }
            return Ok(anotacoes);
        }

        [HttpPost]
        public ActionResult Post(Anotacao anotacao)
        {
            if (anotacao is null)
            {
                return BadRequest();
            }
            _context.Anotacoes.Add(anotacao);
            _context.SaveChanges();
            return Ok();
        }

        [HttpPut("{id}")]
        public ActionResult Put(int id, Anotacao anotacao)
        {
            var anotacoes = _context.Anotacoes.SingleOrDefault(anotacao => anotacao.Id == id);

            if (anotacoes is null)
            {
                return NotFound();
            }

            anotacoes.Update(anotacao.Nome, anotacao.Descricao, anotacao.DataNota, anotacao.IdUsuario, anotacao.TipoUsuario);
            _context.SaveChanges();
            return Ok(anotacoes);

        }

        [HttpDelete("{id}")]
        public ActionResult Delete(int id)
        {
            var anotacao = _context.Anotacoes.Find(id); //pegando anotacao que tenha o id informado

            if (anotacao == null)
            {
                //Retorna não encontrou a anotacao
                return NoContent();
            }

            _context.Anotacoes.Remove(anotacao); // Marca a anotacao para exclusão
            _context.SaveChanges();

            return Ok();

        }
    }
}
