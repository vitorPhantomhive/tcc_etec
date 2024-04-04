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
            if(alunos is null)
            {
                return NoContent();
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
    }
}
