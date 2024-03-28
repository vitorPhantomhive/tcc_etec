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
        public ActionResult<>

    }
}
