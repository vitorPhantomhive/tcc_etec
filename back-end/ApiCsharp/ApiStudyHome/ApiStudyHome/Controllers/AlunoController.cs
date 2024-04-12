using ApiStudyHome.Context;
using ApiStudyHome.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace ApiStudyHome.Controllers
{
    [ApiController]
    [Route("[controller]")]
    public class AlunoController : Controller
    {
        private readonly AppDbContext _context;

        public AlunoController(AppDbContext context)
        {
            _context = context;
        }
        //falando que esse metodo atende a requisição como ação GET
        [HttpGet]
        public ActionResult<IEnumerable<Aluno>> Get()
        {
            var alunos = _context.Alunos.ToList();
            if (alunos is null)
            {
                return NoContent();
            }
            return alunos;
        }

        [HttpGet("{id}")]
        public ActionResult<Aluno> GetById(int id)
        {
            var alunos = _context.Alunos.SingleOrDefault(alunos => alunos.Id == id);
            if (alunos is null)
            {
                return NotFound();
            }
            return alunos;
        }

        [HttpPost]
        public ActionResult Post(Aluno aluno)
        {
            if (aluno is null)
            {
                return BadRequest();
            }
            _context.Alunos.Add(aluno);
            _context.SaveChanges();

            return Ok();
        }
        [HttpPut("{id}")]
        public ActionResult Put(int id, Aluno aluno)
        {

            var alunos = _context.Alunos.SingleOrDefault(aluno => aluno.Id == id);

            if(alunos is null)
            {
                return NotFound();
            }
            aluno.Update((int)aluno.TurmaId, aluno.Nome, aluno.Email, aluno.Senha, aluno.Telefone, aluno.Ativo, aluno.Cpf);
            return Ok();
        }

    }
}
