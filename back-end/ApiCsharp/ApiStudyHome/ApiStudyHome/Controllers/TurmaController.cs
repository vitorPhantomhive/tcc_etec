using ApiStudyHome.Context;
using ApiStudyHome.Models;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

namespace ApiStudyHome.Controllers
{
    [ApiController]
    [Route("[controller]")]
    public class TurmaController : ControllerBase
    {
        private readonly AppDbContext _context;

        public TurmaController(AppDbContext context)
        {
            _context = context;
        }

        [HttpGet]
        public ActionResult<IEnumerable<Turma>> Get()
        {
            var turmas = _context.Turmas.ToList();
            if(turmas is null)
            {
                return NoContent();
            }
            return Ok(turmas);
        }
        [HttpGet("{id}")]
        public ActionResult<IEnumerable<Turma>> GetById(int id)
        {
            var turma = _context.Escolas.SingleOrDefault(d => d.Id == id);
            if (turma is null)
            {
                return NotFound();
            }
            return Ok(turma);
        }
        [HttpPost]
        public ActionResult Post(Turma turma)
        {
            if (turma is null)
            {
                return BadRequest();
            }
            _context.Turmas.Add(turma);
            _context.SaveChanges();
            return Ok();
        }
        [HttpPut]
        public ActionResult Put(int id, Turma turma)
        {
            var turma_bd = _context.Turmas.SingleOrDefault(turma => turma.Id == id);

            if (turma_bd is null)
            {
                return NotFound();
            }

            turma_bd.Update(turma.Id, turma.Nome);
            _context.SaveChanges();
            return Ok(turma_bd);

        }
        [HttpDelete]
        public ActionResult Delete(int id)
        {
            var turma_bd = _context.Turmas.Find(id);
            if(turma_bd is null)
            {
                return NotFound();
            }
            _context.Remove(turma_bd);
            _context.SaveChanges();
            return Ok();
        }
    }
}
