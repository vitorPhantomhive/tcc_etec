using ApiStudyHome.Context;
using ApiStudyHome.Models;
using Microsoft.AspNetCore.Mvc;

namespace ApiStudyHome.Controllers
{
    [ApiController]
    [Route("[controller]")]
    public class ProfessorController : ControllerBase
    {
        private readonly AppDbContext _context;
        public ProfessorController(AppDbContext context)
        {
            _context = context;
        }
        [HttpGet]
        public ActionResult<IEnumerable<Professor>> Get()
        {
            var professores = _context.Professores.ToList();
            if (professores.Count == 0)
            {
                return NoContent();
            }
            return professores;

        }

        [HttpGet("{id}")]
        public ActionResult<IEnumerable<Professor>> GetById(int id)
        {
            var professores = _context.Professores.SingleOrDefault(professores => professores.Id == id);
            if (professores is null)
            {
                return NotFound();
            }
            return Ok(professores);
        }

        [HttpPost]
        public ActionResult Post(Professor professores)
        {
            if (professores is null)
            {
                return BadRequest();
            }
            _context.Professores.Add(professores);
            _context.SaveChanges();
            return Ok();
        }

        [HttpPut("{id}")]
        public ActionResult Put(int id, Professor professor)
        {
            var professores = _context.Professores.SingleOrDefault(professor => professor.Id == id);

            if (professores is null)
            {
                return NotFound();
            }
            professor.Update(professor.Nome, professor.Email, professor.Senha, professor.Telefone, professor.Ativo, professor.Cpf);
            _context.SaveChanges();

            return Ok(professores);
        }

        [HttpDelete("{id}")]
        public ActionResult Delete(int id)
        {
            var professor = _context.Professores.SingleOrDefault(p => p.Id == id);
            if (professor is null)
            {
                return BadRequest();
            }
            _context.Professores.Remove(professor);
            _context.SaveChanges();
            return Ok();
        }
    }
}
