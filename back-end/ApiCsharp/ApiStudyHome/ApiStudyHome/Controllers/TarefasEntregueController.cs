using ApiStudyHome.Context;
using ApiStudyHome.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace ApiStudyHome.Controllers
{
    [ApiController]
    [Route("[controller]")]
    public class TarefasEntregueController : ControllerBase
    {
        private readonly AppDbContext _context;
        public TarefasEntregueController(AppDbContext context)
        {
            _context = context;
        }

        [HttpGet]
        public ActionResult<IEnumerable<TarefaEntregue>> Get()
        {
            var tarefas_entregues = _context.ArquivoEntregues.ToList();

            if(tarefas_entregues is null || tarefas_entregues.Count == 0)
            {
                return NoContent(); 
            }

            return Ok(tarefas_entregues);
        }
        [HttpGet("{id}")]
        public ActionResult<IEnumerable<TarefaEntregue>> GetById(int id)
        {
            var tarefas_entregues = _context.Escolas.SingleOrDefault(d => d.Id == id);
            if (tarefas_entregues is null)
            {
                return NotFound();
            }
            return Ok(tarefas_entregues);
        }
        [HttpPost]
        public ActionResult Post(TarefaEntregue tarefaEntregue)
        {
            if (tarefaEntregue is null)
            {
                return BadRequest();
            }
            _context.Entregue.Add(tarefaEntregue);
            _context.SaveChanges();
            return Ok();
        }
        [HttpPut("{id}")]
        public ActionResult Put(int id, TarefaEntregue escola)
        {
            var tarefas_entregues = _context.Entregue.SingleOrDefault(tarefas_entregues => tarefas_entregues.Id == id);

            if (tarefas_entregues is null)
            {
                return NotFound();
            }

            tarefas_entregues.Update(tarefas_entregues.IdAluno, tarefas_entregues.IdTarefa, tarefas_entregues.ComentariosProfessor, tarefas_entregues.ComentariosAluno);
            _context.SaveChanges();
            return Ok(tarefas_entregues);

        }

        [HttpDelete("{id}")]
        public ActionResult Delete(int id)
        {
            var tarefas_entregues = _context.Tarefas.Find(id); 

            if (tarefas_entregues == null)
            {
                
                return NoContent();
            }

            _context.Tarefas.Remove(tarefas_entregues); 
            _context.SaveChanges();

            return Ok();

        }

    }
}
